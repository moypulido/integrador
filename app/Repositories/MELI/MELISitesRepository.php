<?php

namespace App\Repositories\MELI;

use App\Interfaces\MELI\MELISitesRepositoryInterface;
use App\Interfaces\TokenRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;
use Termwind\Components\Dd;

use function PHPSTORM_META\type;

class MELISitesRepository implements MELISitesRepositoryInterface
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

    public function getItemsbyUser($sort = null, $filters = [])
    {
        $user = $this->userRepository->getAuthenticatedUser();


        $headers = [
            'Authorization' => 'Bearer ' . $this->tokenRepository->getLastToken()->access_token,
        ];


        try {
            $url = 'https://api.mercadolibre.com/sites/' . $user->site . '/search?seller_id=' . $user->id_meli;

            if ($sort) {
                $url .= '&sort=' . $sort;
            }

            if (!empty($filters)) {
                foreach ($filters as $key => $value) {
                    $url .= '&' . $key . '=' . $value;
                }
            }


            $request = new Request('GET', $url, $headers);

            // dd($request);

            $response = $this->client->sendAsync($request)->wait();
            return json_decode($response->getBody()->getContents());
        } catch (RequestException $e) {
            Log::error('Error to get items by user: ' . $e->getMessage());
            return null;
        }
    }
}
