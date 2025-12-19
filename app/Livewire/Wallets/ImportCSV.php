<?php

namespace App\Livewire\Wallets;

use App\Models\Wallet;
use App\Services\Parsers\BinanceCSVParser;
use App\Services\WalletSyncService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImportCSV extends Component
{
    use WithFileUploads;

    public $file;
    public int $walletId = 0;
    public string $exchange = 'binance';
    public string $walletName = '';
    public bool $isProcessing = false;
    public bool $showPreview = false;
    public array $preview = [];
    public array $validationErrors = [];
    public ?string $successMessage = null;
    public int $importedCount = 0;

    protected $rules = [
        'file' => 'required|file|mimes:csv,txt,xlsx,xls|max:10240',
    ];

    protected $messages = [
        'file.required' => 'Selecione um arquivo para importar.',
        'file.mimes' => 'O arquivo deve ser CSV, XLS ou XLSX.',
        'file.max' => 'O arquivo deve ter no máximo 10MB.',
    ];

    public function updatedFile()
    {
        $this->validate();
        $this->validationErrors = [];
        $this->successMessage = null;
        $this->showPreview = false;

        if ($this->file) {
            $this->validateAndPreview();
        }
    }

    protected function validateAndPreview()
    {
        try {
            $path = $this->file->getRealPath();
            $parser = app(BinanceCSVParser::class);

            $errors = $parser->validate($path);

            if (!empty($errors)) {
                $this->validationErrors = $errors;
                return;
            }

            $this->preview = $parser->preview($path, 5);
            $this->showPreview = true;
        } catch (\Exception $e) {
            $this->validationErrors = ['Erro ao processar arquivo: ' . $e->getMessage()];
        }
    }

    public function import()
    {
        $this->validate();

        if (!$this->file) {
            $this->validationErrors = ['Selecione um arquivo para importar.'];
            return;
        }

        $this->isProcessing = true;
        $this->successMessage = null;
        $this->validationErrors = [];

        try {
            $filename = 'imports/' . Auth::id() . '/' . time() . '_' . $this->file->getClientOriginalName();
            $path = $this->file->storeAs('imports/' . Auth::id(), time() . '_' . $this->file->getClientOriginalName(), 'local');
            $fullPath = Storage::disk('local')->path($path);

            $wallet = $this->getOrCreateWallet();

            $syncService = app(WalletSyncService::class);
            $result = $syncService->importFromFile($wallet, $fullPath);

            if ($result['success']) {
                $this->importedCount = $result['imported'];
                $this->successMessage = $result['message'];
                $this->dispatch('csv-imported', walletId: $wallet->id, count: $this->importedCount);
            } else {
                $this->validationErrors = [$result['error']];
            }
        } catch (\Exception $e) {
            Log::error('CSV Import error', [
                'error' => $e->getMessage(),
                'user_id' => Auth::id(),
            ]);
            $this->validationErrors = ['Erro ao importar arquivo: ' . $e->getMessage()];
        } finally {
            $this->isProcessing = false;
        }
    }

    protected function getOrCreateWallet(): Wallet
    {
        if ($this->walletId > 0) {
            return Wallet::findOrFail($this->walletId);
        }

        $name = $this->walletName ?: ucfirst($this->exchange) . ' (CSV Import)';

        return Wallet::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'name' => $name,
            ],
            [
                'type' => 'exchange',
                'status' => 'active',
            ]
        );
    }

    #[On('set-wallet')]
    public function setWallet(int $walletId)
    {
        $this->walletId = $walletId;
    }

    #[On('set-exchange')]
    #[On('set-exchange-csv')]
    public function setExchange(string $exchange, string $name = '')
    {
        $this->exchange = strtolower($exchange);
        $this->walletName = $name ?: ucfirst($exchange);
    }

    public function resetForm()
    {
        $this->reset(['file', 'showPreview', 'preview', 'validationErrors', 'successMessage', 'importedCount']);
    }

    public function render()
    {
        return view('livewire.wallets.import-c-s-v');
    }
}
