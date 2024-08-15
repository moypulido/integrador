<?php

namespace App\Repositories\MELI;


use App\Interfaces\MELI\MELIPacksRepositoryInterface;
use App\Interfaces\TokenRepositoryInterface;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;


class MELIPacksRepository implements MELIPacksRepositoryInterface
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

    public function getPack($pack_id)
    {

        $headers = [
            'Authorization' => 'Bearer ' . $this->tokenRepository->getLastToken()->access_token,
        ];

        $url = 'https://api.mercadolibre.com/packs/' . $pack_id;

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
