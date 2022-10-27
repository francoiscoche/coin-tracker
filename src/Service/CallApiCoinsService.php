<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiCoinsService
{

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }


    /**
     * Use this to obtain all the coins market data (price, market cap, volume)
     *
     * @return array
     */
    public function getCoinsMarkets(): array {

        $response = $this->client->request('GET', 'https://api.coingecko.com/api/v3/coins/markets?', [
            'query' => [
                'vs_currency' => 'usd',
                'order' => 'market_cap_desc',
                'per_page' => 100,
                'page' => 1,
                'sparkline' => false,
            ],
        ]);

        return $response->toArray();
    }

    /**
     * Top-7 trending coins on CoinGecko as searched by users in the last 24 hours (Ordered by most popular first)
     *
     * @return array
     */
    public function getTrending():array {

        $response = $this->client->request('GET', 'https://api.coingecko.com/api/v3/search/trending');
        return $response->toArray();
    }

    /**
     * Get Top 100 Cryptocurrency Global Eecentralized Finance(defi) data)
     *
     * @return array
     */
    public function getDecentralizedFinanceDefi():array {

        $response = $this->client->request('GET', 'https://api.coingecko.com/api/v3/global/decentralized_finance_defi');
        return $response->toArray();
    }
}