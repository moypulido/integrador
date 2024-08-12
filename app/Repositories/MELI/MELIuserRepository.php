<?php

namespace App\Repositories\MELI;

use App\Interfaces\MELI\MELIUserRepositoryInterface;
use GuzzleHttp\Exception\RequestException;
use App\Interfaces\TokenRepositoryInterface;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;
use App\Models\Token;

class MELIuserRepository implements MELIUserRepositoryInterface {
    protected $client;
    protected $tokenRepository;

    public function __construct( TokenRepositoryInterface $tokenRepository ) {
        $this->tokenRepository = $tokenRepository;
        $this->client = new Client();
    }

    public function getUserMe() {

        $refreshToken = $this->tokenRepository->getLastToken();
        
        $headers = [
            'Authorization' => 'Bearer ' . $refreshToken->access_token,
        ];

        try {
            $request = new Request('GET', 'https://api.mercadolibre.com/users/me', $headers);
            $response = $this->client->sendAsync($request)->wait();

            return json_decode($response->getBody()->getContents());
        } catch (RequestException $e) {
            Log::error($e->getMessage());
            return $e->getResponse()->getBody()->getContents();
        }
    }
}