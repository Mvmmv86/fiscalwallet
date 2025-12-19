<?php

namespace App\Livewire\Wallets;

use App\Integrations\BinanceIntegration;
use App\Jobs\SyncWalletJob;
use App\Models\Exchange;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;

class ImportAPI extends Component
{
    public string $walletName = '';
    public string $apiKey = '';
    public string $apiSecret = '';
    public ?string $startDate = null;
    public string $exchange = 'binance';

    public bool $isValidating = false;
    public bool $isImporting = false;
    public bool $credentialsValid = false;

    public array $validationErrors = [];
    public ?string $successMessage = null;
    public int $importedCount = 0;

    public int $step = 1; // 1 = credenciais, 2 = importando, 3 = sucesso

    protected $rules = [
        'walletName' => 'required|min:3|max:100',
        'apiKey' => 'required|min:10',
        'apiSecret' => 'required|min:10',
    ];

    protected $messages = [
        'walletName.required' => 'Digite um nome para a carteira.',
        'walletName.min' => 'O nome deve ter pelo menos 3 caracteres.',
        'apiKey.required' => 'Digite a API Key.',
        'apiKey.min' => 'API Key inválida.',
        'apiSecret.required' => 'Digite a API Secret.',
        'apiSecret.min' => 'API Secret inválida.',
    ];

    public function mount()
    {
        $this->startDate = now()->subYears(2)->format('Y-m-d');
    }

    #[On('set-exchange')]
    public function setExchange(string $exchange, string $name = '')
    {
        $this->exchange = strtolower($exchange);
        $this->walletName = $name ?: ucfirst($exchange);
    }

    public function validateCredentials()
    {
        $this->validate([
            'apiKey' => 'required|min:10',
            'apiSecret' => 'required|min:10',
        ]);

        $this->isValidating = true;
        $this->validationErrors = [];
        $this->credentialsValid = false;

        try {
            $integration = $this->getIntegration();

            if (!$integration) {
                $this->validationErrors = ["Integração para {$this->exchange} não disponível."];
                return;
            }

            $isValid = $integration->validateCredentials($this->apiKey, $this->apiSecret);

            if ($isValid) {
                $this->credentialsValid = true;
                $this->successMessage = 'Credenciais válidas! Clique em Importar para continuar.';
            } else {
                $this->validationErrors = ['Credenciais inválidas. Verifique sua API Key e Secret.'];
            }
        } catch (\Exception $e) {
            Log::error('Credential validation error', [
                'exchange' => $this->exchange,
                'error' => $e->getMessage(),
            ]);
            $this->validationErrors = ['Erro ao validar credenciais: ' . $e->getMessage()];
        } finally {
            $this->isValidating = false;
        }
    }

    public function import()
    {
        $this->validate();

        // Se não validou ainda, pede para validar primeiro
        if (!$this->credentialsValid) {
            $this->validationErrors = ['Por favor, valide as credenciais primeiro clicando em "Validar Credenciais".'];
            return;
        }

        $this->isImporting = true;
        $this->validationErrors = [];
        $this->successMessage = null;

        try {
            // Cria a wallet com as credenciais (operação rápida)
            $wallet = $this->createWallet();

            // Dispara o job de sincronização em background (trabalho pesado)
            SyncWalletJob::dispatch($wallet, true);

            // Vai para o step de "processando"
            $this->step = 3;
            $this->successMessage = "Carteira criada com sucesso! A importação das operações está sendo processada em segundo plano. Isso pode levar alguns minutos.";

            $this->dispatch('api-imported', walletId: $wallet->id, count: 0);

        } catch (\Exception $e) {
            Log::error('API Import error', [
                'exchange' => $this->exchange,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            $this->validationErrors = ['Erro ao importar: ' . $e->getMessage()];
            $this->step = 1;
        } finally {
            $this->isImporting = false;
        }
    }

    protected function createWallet(): Wallet
    {
        $exchange = Exchange::where('slug', $this->exchange)->first();

        return Wallet::create([
            'user_id' => Auth::id(),
            'exchange_id' => $exchange?->id,
            'name' => $this->walletName ?: ucfirst($this->exchange),
            'import_type' => 'api',
            'import_start_date' => $this->startDate ? \Carbon\Carbon::parse($this->startDate)->toDateString() : null,
            'api_key' => Crypt::encryptString($this->apiKey),
            'api_secret' => Crypt::encryptString($this->apiSecret),
            'status' => 'syncing',
        ]);
    }

    protected function getIntegration()
    {
        return match ($this->exchange) {
            'binance' => app(BinanceIntegration::class),
            default => null,
        };
    }

    public function resetForm()
    {
        $this->reset([
            'apiKey', 'apiSecret', 'credentialsValid',
            'validationErrors', 'successMessage', 'importedCount', 'step'
        ]);
        $this->step = 1;
    }

    public function render()
    {
        return view('livewire.wallets.import-a-p-i');
    }
}
