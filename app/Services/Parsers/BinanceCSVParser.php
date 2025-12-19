<?php

namespace App\Services\Parsers;

use App\DTOs\NormalizedOperation;
use App\Services\CurrencyConverterService;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class BinanceCSVParser
{
    protected CurrencyConverterService $converter;

    protected array $typeMapping = [
        'buy' => 'buy',
        'sell' => 'sell',
        'deposit' => 'deposit',
        'withdraw' => 'withdrawal',
        'transfer' => 'transfer_in',
        'commission' => 'fee',
        'referral' => 'reward',
        'staking rewards' => 'reward',
        'savings interest' => 'reward',
        'distribution' => 'reward',
        'airdrop' => 'reward',
        'fiat deposit' => 'deposit',
        'fiat withdraw' => 'withdrawal',
        'p2p trading' => 'buy',
        'convert' => 'swap_in',
        'small assets exchange bnb' => 'swap_in',
    ];

    public function __construct(CurrencyConverterService $converter)
    {
        $this->converter = $converter;
    }

    /**
     * Parse arquivo CSV da Binance
     */
    public function parse(string $filePath): Collection
    {
        $operations = collect();
        $handle = fopen($filePath, 'r');

        if ($handle === false) {
            throw new \Exception('Não foi possível abrir o arquivo CSV.');
        }

        $header = fgetcsv($handle);
        $headerMap = $this->mapHeader($header);

        $rowNumber = 1;
        while (($row = fgetcsv($handle)) !== false) {
            $rowNumber++;

            try {
                $operation = $this->parseRow($row, $headerMap);
                if ($operation) {
                    $operations->push($operation);
                }
            } catch (\Exception $e) {
                Log::warning("Error parsing Binance CSV row {$rowNumber}", [
                    'error' => $e->getMessage(),
                    'row' => $row,
                ]);
            }
        }

        fclose($handle);

        return $operations;
    }

    /**
     * Mapeia cabeçalho para índices
     */
    protected function mapHeader(array $header): array
    {
        $map = [];
        $normalizedHeader = array_map(fn ($h) => strtolower(trim($h)), $header);

        $columnMappings = [
            'date' => ['utc_time', 'date(utc)', 'time', 'date', 'timestamp'],
            'type' => ['operation', 'type', 'transaction type', 'operation_type'],
            'asset' => ['coin', 'asset', 'currency', 'symbol'],
            'amount' => ['change', 'amount', 'quantity', 'qty'],
            'remark' => ['remark', 'note', 'notes', 'description'],
            'price' => ['price', 'unit_price', 'rate'],
            'fee' => ['fee', 'commission', 'fee_amount'],
            'total' => ['total', 'total_amount', 'value'],
        ];

        foreach ($columnMappings as $key => $possibleNames) {
            foreach ($possibleNames as $name) {
                $index = array_search($name, $normalizedHeader);
                if ($index !== false) {
                    $map[$key] = $index;
                    break;
                }
            }
        }

        return $map;
    }

    /**
     * Parse uma linha do CSV
     */
    protected function parseRow(array $row, array $headerMap): ?NormalizedOperation
    {
        $dateStr = $row[$headerMap['date'] ?? 0] ?? '';
        $type = strtolower($row[$headerMap['type'] ?? 1] ?? '');
        $asset = strtoupper($row[$headerMap['asset'] ?? 2] ?? '');
        $amount = $this->parseNumber($row[$headerMap['amount'] ?? 3] ?? '0');
        $remark = $row[$headerMap['remark'] ?? 4] ?? '';

        if (empty($asset) || $amount == 0) {
            return null;
        }

        $executedAt = $this->parseDate($dateStr);
        $normalizedType = $this->normalizeType($type, $amount, $remark);

        if (!$normalizedType || $normalizedType === 'skip') {
            return null;
        }

        $quantity = abs($amount);

        $priceBrl = $this->converter->getAssetPriceInBrl($asset, $executedAt) ?? 0;
        $usdBrlRate = $this->converter->getUsdBrlRate($executedAt);
        $priceUsd = $usdBrlRate > 0 ? $priceBrl / $usdBrlRate : 0;

        $totalBrl = $quantity * $priceBrl;
        $totalUsd = $quantity * $priceUsd;

        $fee = $this->parseNumber($row[$headerMap['fee'] ?? -1] ?? '0');
        $feeBrl = abs($fee) * $priceBrl;
        $feeUsd = abs($fee) * $priceUsd;

        $externalId = $this->generateExternalId($row, $executedAt);

        return new NormalizedOperation(
            externalId: $externalId,
            symbol: $asset,
            type: $normalizedType,
            quantity: $quantity,
            priceUsd: $priceUsd,
            priceBrl: $priceBrl,
            totalUsd: $totalUsd,
            totalBrl: $totalBrl,
            feeUsd: $feeUsd,
            feeBrl: $feeBrl,
            executedAt: $executedAt,
            source: 'binance_csv',
            rawData: array_combine(array_keys($headerMap), array_intersect_key($row, array_flip(array_values($headerMap)))),
        );
    }

    /**
     * Normaliza tipo de operação
     */
    protected function normalizeType(string $type, float $amount, string $remark): ?string
    {
        $type = strtolower(trim($type));

        if (isset($this->typeMapping[$type])) {
            $mappedType = $this->typeMapping[$type];

            if ($mappedType === 'buy' || $mappedType === 'swap_in') {
                return $amount > 0 ? 'buy' : 'sell';
            }

            return $mappedType;
        }

        if (str_contains($type, 'buy') || str_contains($type, 'compra')) {
            return 'buy';
        }

        if (str_contains($type, 'sell') || str_contains($type, 'venda')) {
            return 'sell';
        }

        if (str_contains($type, 'deposit')) {
            return 'deposit';
        }

        if (str_contains($type, 'withdraw')) {
            return 'withdrawal';
        }

        if (str_contains($type, 'convert') || str_contains($type, 'swap')) {
            return $amount > 0 ? 'swap_in' : 'swap_out';
        }

        if (str_contains($type, 'transfer')) {
            return $amount > 0 ? 'transfer_in' : 'transfer_out';
        }

        if (str_contains($type, 'reward') || str_contains($type, 'interest') || str_contains($type, 'staking')) {
            return 'reward';
        }

        if ($amount > 0) {
            return 'deposit';
        } else {
            return 'withdrawal';
        }
    }

    /**
     * Parse data em diversos formatos
     */
    protected function parseDate(string $dateStr): Carbon
    {
        $formats = [
            'Y-m-d H:i:s',
            'Y-m-d\TH:i:s',
            'Y-m-d\TH:i:s.u\Z',
            'd/m/Y H:i:s',
            'd/m/Y H:i',
            'd/m/Y',
            'm/d/Y H:i:s',
            'Y-m-d',
        ];

        foreach ($formats as $format) {
            try {
                return Carbon::createFromFormat($format, trim($dateStr));
            } catch (\Exception $e) {
                continue;
            }
        }

        try {
            return Carbon::parse($dateStr);
        } catch (\Exception $e) {
            return now();
        }
    }

    /**
     * Parse número com diferentes formatos
     */
    protected function parseNumber(string $value): float
    {
        $value = trim($value);

        $value = str_replace([' ', '_'], '', $value);

        if (str_contains($value, ',') && str_contains($value, '.')) {
            if (strrpos($value, ',') > strrpos($value, '.')) {
                $value = str_replace('.', '', $value);
                $value = str_replace(',', '.', $value);
            } else {
                $value = str_replace(',', '', $value);
            }
        } elseif (str_contains($value, ',')) {
            $parts = explode(',', $value);
            if (count($parts) === 2 && strlen(end($parts)) <= 2) {
                $value = str_replace(',', '.', $value);
            } else {
                $value = str_replace(',', '', $value);
            }
        }

        return (float) $value;
    }

    /**
     * Gera ID externo único para a operação
     */
    protected function generateExternalId(array $row, Carbon $date): string
    {
        $data = implode('|', $row) . '|' . $date->getTimestampMs();
        return 'csv_' . md5($data);
    }

    /**
     * Valida se arquivo é um CSV válido da Binance
     */
    public function validate(string $filePath): array
    {
        $errors = [];

        if (!file_exists($filePath)) {
            $errors[] = 'Arquivo não encontrado.';
            return $errors;
        }

        $handle = fopen($filePath, 'r');
        if ($handle === false) {
            $errors[] = 'Não foi possível abrir o arquivo.';
            return $errors;
        }

        $header = fgetcsv($handle);
        fclose($handle);

        if (empty($header)) {
            $errors[] = 'Arquivo CSV vazio ou inválido.';
            return $errors;
        }

        $normalizedHeader = array_map(fn ($h) => strtolower(trim($h)), $header);

        $requiredColumns = ['date', 'utc_time', 'time', 'timestamp'];
        $hasDateColumn = false;
        foreach ($requiredColumns as $col) {
            if (in_array($col, $normalizedHeader)) {
                $hasDateColumn = true;
                break;
            }
        }

        if (!$hasDateColumn) {
            $errors[] = 'Coluna de data não encontrada no CSV.';
        }

        $assetColumns = ['coin', 'asset', 'currency', 'symbol'];
        $hasAssetColumn = false;
        foreach ($assetColumns as $col) {
            if (in_array($col, $normalizedHeader)) {
                $hasAssetColumn = true;
                break;
            }
        }

        if (!$hasAssetColumn) {
            $errors[] = 'Coluna de ativo não encontrada no CSV.';
        }

        return $errors;
    }

    /**
     * Retorna preview das primeiras linhas
     */
    public function preview(string $filePath, int $lines = 5): array
    {
        $handle = fopen($filePath, 'r');
        if ($handle === false) {
            return [];
        }

        $header = fgetcsv($handle);
        $rows = [];

        $count = 0;
        while (($row = fgetcsv($handle)) !== false && $count < $lines) {
            $rows[] = array_combine($header, $row);
            $count++;
        }

        fclose($handle);

        return [
            'header' => $header,
            'rows' => $rows,
            'total_columns' => count($header),
        ];
    }
}
