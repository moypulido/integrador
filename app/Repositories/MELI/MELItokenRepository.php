<?php

namespace App\Repositories\MELI;

use App\Interfaces\MELI\MELItokenRepositoryInterface;

use App\Interfaces\TokenRepositoryInterface;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;

class MELItokenRepository implements MELItokenRepositoryInterface
{
    protected $clientId;
    protected $clientSecret;
    protected $apiUrl;
    protected $code;
    public $httpClient;
    protected $tokenRepository;

    public function __construct(TokenRepositoryInterface $tokenRepository)
    {
        $this->clientId = config('services.mercadolibre.client_id');
        $this->clientSecret = config('services.mercadolibre.client_secret');
        $this->apiUrl = 'https://api.mercadolibre.com';
        $this->httpClient = new Client();
        $this->tokenRepository = $tokenRepository;
    }

    public function refreshToken($code)
    {
        $lastToken = $this->tokenRepository->getLastToken();


        if ($lastToken && now()->lt($lastToken->expires_at)) {
            return $lastToken->attributesToArray();
        }

        $headers = [
            'accept' => 'application/json',
            'Content-Type' => 'application/x-www-form-urlencoded',
        ];

        $options = [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
                'refresh_token' => $code,
            ]
        ];

        try {
            $request = new Request('POST', "{$this->apiUrl}/oauth/token", $headers);
            $response = $this->httpClient->send($request, $options);
            $token = json_decode($response->getBody()->getContents(), true);

            $token = $this->tokenRepository->saveToken([
                'access_token' => $token['access_token'],
                'token_type' => $token['token_type'],
                'expires_at' => now()->addSeconds($token['expires_in']),
                'scope' => $token['scope'],
                'user_id' => $token['user_id'],
                'refresh_token' => $token['refresh_token'],
            ]);

            return $token->attributesToArray();
        } catch (RequestException $e) {
            Log::error($e->getMessage());
            return null;
        }
    }
}
