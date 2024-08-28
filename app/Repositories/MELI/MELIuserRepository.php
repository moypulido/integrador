<?php

namespace App\Repositories\MELI;

use App\Interfaces\MELI\MELIUserRepositoryInterface;
use App\Interfaces\TokenRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;

class MELIuserRepository implements MELIUserRepositoryInterface
{
    protected $client;
    protected $tokenRepository;
    protected $userRepository;

    public function __construct(
        TokenRepositoryInterface $tokenRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->tokenRepository = $tokenRepository;
        $this->userRepository = $userRepository;
        $this->client = new Client();
    }

    public function getUserMe()
    {
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

    public function getItems($orders = null, $filters = [], $limit = 5, $offset = 0)
    {
        $user = $this->userRepository->getAuthenticatedUser();

        // dd($sort, $filters, $limit, $offset);

        $headers = [
            'Authorization' => 'Bearer ' . $this->tokenRepository->getLastToken()->access_token,
        ];


        try {
            $url = 'https://api.mercadolibre.com/users/' . $user->id_meli . '/items/search?include_filters=true';

            if ($orders) {
                $url .= '&orders=' . $orders;
            }

            if (!empty($filters)) {
                foreach ($filters as $key => $value) {
                    if (is_array($value)) {
                        $value = implode(',', $value);
                    }
                    $url .= '&' . $key . '=' . urlencode($value);
                }
            }

            $url .= '&limit=' . $limit . '&offset=' . $offset;

            // dd($url);

            $request = new Request('GET', $url, $headers);

            $response = $this->client->sendAsync($request)->wait();
            return json_decode($response->getBody()->getContents());
        } catch (RequestException $e) {
            Log::error('Error to get items by user: ' . $e->getMessage());
            return null;
        }
    }
}
