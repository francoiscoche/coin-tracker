<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiCoinsService
{

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }


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
}