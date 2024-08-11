<?php

namespace App\Repositories\MELI;

use App\Interfaces\MELI\tokenRepositoryInterface;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;
use App\Models\Token;

class tokenRepository implements tokenRepositoryInterface
{
    protected $clientId;
    protected $clientSecret;
    protected $redirectUri;
    protected $apiUrl;
    protected $code;
    public $httpClient;

    public function __construct()
    {
        $this->clientId = env('MELI_CLIENT_ID');
        $this->clientSecret = env('MELI_CLIENT_SECRET');
        $this->redirectUri = env('MELI_REDIRECT_URI');
        $this->code = env('MELI_CODE');
        $this->apiUrl = 'https://api.mercadolibre.com';
        $this->httpClient = new Client();
    }

    public function refreshToken($refreshToken)
    {
        $lastToken = Token::latest()->first();

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
                'refresh_token' => $refreshToken,
            ]
        ];

        try {
            $request = new Request('POST', "{$this->apiUrl}/oauth/token", $headers);
            $response = $this->httpClient->send($request, $options);
            $token = json_decode($response->getBody()->getContents(), true); 

            $token = Token::create([
                'access_token' => $token['access_token'],
                'token_type' => $token['token_type'],
                'expires_at' => now()->addSeconds($token['expires_in']),
                'scope' => $token['scope'],
                'user_id' => $token['user_id'],
                'refresh_token' => $token['refresh_token'],
            ]);
            $lastToken = Token::latest()->first();

            return $lastToken->attributesToArray();
        } catch (RequestException $e) {
            Log::error($e->getMessage());
            return null;
        }
    }
}
