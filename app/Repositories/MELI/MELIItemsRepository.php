<?php

namespace App\Repositories\MELI;

use App\Interfaces\MELI\MELIItemsRepositoryInterface;
use App\Interfaces\TokenRepositoryInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Psr7\Request;

class MELIItemsRepository implements MELIItemsRepositoryInterface
{

    protected $client;
    protected $tokenRepository;

    public function __construct(
        TokenRepositoryInterface $tokenRepository
    ) {
        $this->tokenRepository = $tokenRepository;
        $this->client = new Client();
    }

    public function getItem($item_id)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->tokenRepository->getLastToken()->access_token,
            'x-format-new'  => 'true'
        ];

        $url = 'https://api.mercadolibre.com/items/' . $item_id;

        try {
            $request = new Request('GET', $url, $headers);
            $response = $this->client->sendAsync($request)->wait();
            return json_decode($response->getBody()->getContents());
        } catch (RequestException $e) {
            Log::error($e->getMessage());
            return $e->getResponse()->getBody()->getContents();
        }
    }
}
