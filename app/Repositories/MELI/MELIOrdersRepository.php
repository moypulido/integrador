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

    public function __construct(
        TokenRepositoryInterface $tokenRepository
    ) {
        $this->tokenRepository = $tokenRepository;
        $this->client = new Client();
    }

    public function getOrders($seller_id, $filters = [], $sort = null, $limit = 10, $offset = 0)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->tokenRepository->getLastToken()->access_token,
            'x-format-new'  => 'true'
        ];

        $queryParams = array_merge([
            'seller' => $seller_id,
            'limit' => $limit,
            'offset' => $offset,

        ], $filters);

        if ($sort) {
            $queryParams['sort'] = $sort;
        }

        $queryString = http_build_query($queryParams);
        $url = 'https://api.mercadolibre.com/orders/search?' . $queryString;


        try {
            $request = new Request('GET', $url, $headers);
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
            'x-format-new'  => 'true'
        ];

        $url = 'https://api.mercadolibre.com/orders/' . $order_id;

        try {
            $request = new Request('GET', $url, $headers);
            $response = $this->client->sendAsync($request)->wait();
            return json_decode($response->getBody()->getContents());
        } catch (RequestException $e) {
            if ($e->getResponse()->getStatusCode() == 404) {
                return null;
            }
            Log::error($e->getMessage());
            return null;
        }
    }
}
