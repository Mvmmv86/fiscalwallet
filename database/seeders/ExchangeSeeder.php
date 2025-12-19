<?php

namespace Database\Seeders;

use App\Models\Exchange;
use Illuminate\Database\Seeder;

class ExchangeSeeder extends Seeder
{
    public function run(): void
    {
        $exchanges = [
            [
                'name' => 'Binance',
                'slug' => 'binance',
                'logo_url' => '/images/exchanges/binance.svg',
                'type' => 'exchange',
                'api_docs_url' => 'https://binance-docs.github.io/apidocs/',
                'is_active' => true,
            ],
            [
                'name' => 'Coinbase',
                'slug' => 'coinbase',
                'logo_url' => '/images/exchanges/coinbase.svg',
                'type' => 'exchange',
                'api_docs_url' => 'https://docs.cloud.coinbase.com/',
                'is_active' => true,
            ],
            [
                'name' => 'MetaMask',
                'slug' => 'metamask',
                'logo_url' => '/images/exchanges/metamask.svg',
                'type' => 'wallet',
                'api_docs_url' => null,
                'is_active' => true,
            ],
            [
                'name' => 'Mercado Bitcoin',
                'slug' => 'mercado-bitcoin',
                'logo_url' => '/images/exchanges/mercado-bitcoin.svg',
                'type' => 'exchange',
                'api_docs_url' => 'https://www.mercadobitcoin.com.br/api-doc/',
                'is_active' => true,
            ],
            [
                'name' => 'Kraken',
                'slug' => 'kraken',
                'logo_url' => '/images/exchanges/kraken.svg',
                'type' => 'exchange',
                'api_docs_url' => 'https://docs.kraken.com/',
                'is_active' => true,
            ],
            [
                'name' => 'KuCoin',
                'slug' => 'kucoin',
                'logo_url' => '/images/exchanges/kucoin.svg',
                'type' => 'exchange',
                'api_docs_url' => 'https://docs.kucoin.com/',
                'is_active' => true,
            ],
        ];

        foreach ($exchanges as $exchange) {
            Exchange::updateOrCreate(
                ['slug' => $exchange['slug']],
                $exchange
            );
        }
    }
}
