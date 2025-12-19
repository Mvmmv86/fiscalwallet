<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | CoinMarketCap API
    |--------------------------------------------------------------------------
    |
    | CoinMarketCap é usado como fonte primária para cotações de criptomoedas.
    | O plano Startup ($79/mês) é necessário para cotações históricas.
    |
    */

    'coinmarketcap' => [
        'api_key' => env('COINMARKETCAP_API_KEY'),
        'base_url' => env('COINMARKETCAP_BASE_URL', 'https://pro-api.coinmarketcap.com'),
        'timeout' => env('COINMARKETCAP_TIMEOUT', 30),
    ],

    /*
    |--------------------------------------------------------------------------
    | Binance API
    |--------------------------------------------------------------------------
    |
    | Binance é usado como fallback para cotações e como fonte de dados
    | de operações dos usuários.
    |
    */

    'binance' => [
        'base_url' => env('BINANCE_BASE_URL', 'https://api.binance.com'),
        'futures_url' => env('BINANCE_FUTURES_URL', 'https://fapi.binance.com'),
        'timeout' => env('BINANCE_TIMEOUT', 30),
    ],

    /*
    |--------------------------------------------------------------------------
    | Coinbase API
    |--------------------------------------------------------------------------
    |
    | Coinbase integration settings.
    |
    */

    'coinbase' => [
        'base_url' => env('COINBASE_BASE_URL', 'https://api.coinbase.com'),
        'timeout' => env('COINBASE_TIMEOUT', 30),
    ],

    /*
    |--------------------------------------------------------------------------
    | Mercado Bitcoin API
    |--------------------------------------------------------------------------
    |
    | Mercado Bitcoin integration settings.
    |
    */

    'mercado_bitcoin' => [
        'base_url' => env('MERCADO_BITCOIN_BASE_URL', 'https://www.mercadobitcoin.net/api'),
        'timeout' => env('MERCADO_BITCOIN_TIMEOUT', 30),
    ],

    /*
    |--------------------------------------------------------------------------
    | Anthropic Claude API (Principal)
    |--------------------------------------------------------------------------
    |
    | Claude é usado como IA principal para o assistente fiscal.
    | Modelo recomendado: claude-3-5-sonnet-20241022
    |
    */

    'anthropic' => [
        'api_key' => env('ANTHROPIC_API_KEY'),
        'base_url' => env('ANTHROPIC_BASE_URL', 'https://api.anthropic.com'),
        'model' => env('ANTHROPIC_MODEL', 'claude-sonnet-4-20250514'),
        'max_tokens' => env('ANTHROPIC_MAX_TOKENS', 2048),
        'timeout' => env('ANTHROPIC_TIMEOUT', 60),
    ],

    /*
    |--------------------------------------------------------------------------
    | OpenAI API (Fallback)
    |--------------------------------------------------------------------------
    |
    | OpenAI é usado como fallback quando Claude não está disponível.
    | Modelo recomendado: gpt-4o
    |
    */

    'openai' => [
        'api_key' => env('OPENAI_API_KEY'),
        'base_url' => env('OPENAI_BASE_URL', 'https://api.openai.com'),
        'model' => env('OPENAI_MODEL', 'gpt-4o'),
        'max_tokens' => env('OPENAI_MAX_TOKENS', 2048),
        'timeout' => env('OPENAI_TIMEOUT', 60),
    ],

];
