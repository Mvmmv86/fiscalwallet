<?php

namespace App\Contracts;

use App\DTOs\NormalizedOperation;
use Carbon\Carbon;
use Illuminate\Support\Collection;

interface ExchangeIntegrationInterface
{
    /**
     * Valida as credenciais da API
     */
    public function validateCredentials(string $apiKey, string $apiSecret): bool;

    /**
     * Busca todas as operações de trade (compra/venda)
     * @return Collection<NormalizedOperation>
     */
    public function fetchTrades(
        string $apiKey,
        string $apiSecret,
        ?Carbon $startTime = null,
        ?Carbon $endTime = null
    ): Collection;

    /**
     * Busca todos os depósitos
     * @return Collection<NormalizedOperation>
     */
    public function fetchDeposits(
        string $apiKey,
        string $apiSecret,
        ?Carbon $startTime = null,
        ?Carbon $endTime = null
    ): Collection;

    /**
     * Busca todos os saques
     * @return Collection<NormalizedOperation>
     */
    public function fetchWithdrawals(
        string $apiKey,
        string $apiSecret,
        ?Carbon $startTime = null,
        ?Carbon $endTime = null
    ): Collection;

    /**
     * Busca todas as operações (trades + depósitos + saques)
     * @return Collection<NormalizedOperation>
     */
    public function fetchAllOperations(
        string $apiKey,
        string $apiSecret,
        ?Carbon $startTime = null,
        ?Carbon $endTime = null
    ): Collection;

    /**
     * Retorna o nome da exchange
     */
    public function getExchangeName(): string;

    /**
     * Retorna o slug da exchange
     */
    public function getExchangeSlug(): string;

    /**
     * Verifica se a exchange suporta importação via CSV
     */
    public function supportsCSVImport(): bool;

    /**
     * Retorna os símbolos de trading suportados
     */
    public function getSupportedSymbols(): array;
}
