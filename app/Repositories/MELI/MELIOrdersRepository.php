<?php

namespace App\Repositories\MELI;

use App\Interfaces\MELI\MELIOrdersRepositoryInterface;
use App\Interfaces\TokenRepositoryInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Psr7\Request;

class MELIOrdersRepository implements MELIOrdersRepositoryInterface
{
    protected $client;
    protected $tokenRepository;
    protected $UserRepository;

    public function __construct(
        TokenRepositoryInterface $tokenRepository
    ) {
        $this->tokenRepository = $tokenRepository;
        $this->client = new Client();
    }

    public function getOrders($seller_id)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->tokenRepository->getLastToken()->access_token,
            'x-format-new'  => 'true'
        ];

        try {
            $request = new Request('GET', 'https://api.mercadolibre.com/orders/search?seller=' . $seller_id, $headers);
            $response = $this->client->sendAsync($request)->wait();
            return json_decode($response->getBody()->getContents());
        } catch (RequestException $e) {
            Log::error($e->getMessage());
            return $e->getResponse()->getBody()->getContents();
        }
    }

    public function getOrder($order_id)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->tokenRepository->getLastToken()->access_token,
        ];

        $url = 'https://api.mercadolibre.com/orders/' . $order_id;

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
