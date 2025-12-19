<?php

namespace App\Livewire\Operations;

use App\Models\Operation;
use App\Models\Wallet;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.dashboard', ['title' => 'Operações'])]
#[Title('Operações')]
class Index extends Component
{
    use WithPagination;

    public string $search = '';
    public string $filterType = '';
    public ?int $filterWallet = null;
    public string $sortField = 'executed_at';
    public string $sortDirection = 'desc';
    public int $perPage = 50;

    protected $queryString = [
        'search' => ['except' => ''],
        'filterType' => ['except' => ''],
        'filterWallet' => ['except' => null],
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingFilterType(): void
    {
        $this->resetPage();
    }

    public function updatingFilterWallet(): void
    {
        $this->resetPage();
    }

    public function sortBy(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        $userId = auth()->id();

        $operations = Operation::where('user_id', $userId)
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('from_asset', 'like', "%{$this->search}%")
                      ->orWhere('to_asset', 'like', "%{$this->search}%")
                      ->orWhere('external_id', 'like', "%{$this->search}%");
                });
            })
            ->when($this->filterType, function ($query) {
                $query->where('type', $this->filterType);
            })
            ->when($this->filterWallet, function ($query) {
                $query->where('wallet_id', $this->filterWallet);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        $wallets = Wallet::where('user_id', $userId)->get();

        $operationTypes = [
            'buy' => 'Compra',
            'sell' => 'Venda',
            'deposit' => 'Depósito',
            'withdrawal' => 'Saque',
            'transfer_in' => 'Transferência Entrada',
            'transfer_out' => 'Transferência Saída',
            'swap_in' => 'Swap Entrada',
            'swap_out' => 'Swap Saída',
        ];

        return view('livewire.operations.index', [
            'operations' => $operations,
            'wallets' => $wallets,
            'operationTypes' => $operationTypes,
        ]);
    }
}
