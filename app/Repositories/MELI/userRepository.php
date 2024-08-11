<?php

namespace App\Repositories\MELI;

use App\Interfaces\MELI\UserRepositoryInterface;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;
use App\Models\Token;

class userRepository implements UserRepositoryInterface {

    protected $refreshToken;
    protected $client;

    public function __construct()
    {
        $this->refreshToken = Token::latest()->first();
        $this->client = new Client();
    }

    public function getUserMe() {
        $headers = [
            'Authorization' => 'Bearer ' . $this->refreshToken->access_token,
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