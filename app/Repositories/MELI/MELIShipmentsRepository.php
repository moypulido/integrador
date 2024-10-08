<?php

namespace App\Repositories\MELI;

use App\Interfaces\MELI\MELIShipmentsRepositoryInterface;
use App\Interfaces\TokenRepositoryInterface;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client;

class MELIShipmentsRepository implements MELIShipmentsRepositoryInterface
{
    protected $client;
    protected $tokenRepository;

    public function __construct(
        TokenRepositoryInterface $tokenRepository
    ) {
        $this->tokenRepository = $tokenRepository;
        $this->client = new Client();
    }

    public function getShipmet($shipment_id)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->tokenRepository->getLastToken()->access_token,
        ];

        $url = 'https://api.mercadolibre.com/shipments/' . $shipment_id;
        try {
            $request = new Request('GET', $url, $headers);
            $response = $this->client->sendAsync($request)->wait();
            return json_decode($response->getBody()->getContents());
        } catch (RequestException $e) {
            Log::error($e->getMessage());
            return $e->getResponse()->getBody()->getContents();
        }
    }

    public function getItemsByShipment($shipment_id)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->tokenRepository->getLastToken()->access_token,
            'x-format-new'  => 'true'
        ];

        $url = 'https://api.mercadolibre.com/shipments/' . $shipment_id . '/items';

        try {
            $request = new Request('GET', $url, $headers);
            $response = $this->client->sendAsync($request)->wait();
            return json_decode($response->getBody()->getContents());
        } catch (RequestException $e) {
            Log::error($e->getMessage());
            return $e->getResponse()->getBody()->getContents();
        }
    }

    public function getShippingLabels($shipment_id)
    {
        $headers = [
            'Authorization' => 'Bearer ' . $this->tokenRepository->getLastToken()->access_token,
        ];

        $url = 'https://api.mercadolibre.com/shipment_labels?shipment_ids=' . $shipment_id . '&response_type=pdf';

        try {
            $request = new Request('GET', $url, $headers);
            $response = $this->client->sendAsync($request)->wait();
            return $response->getBody()->getContents();
        } catch (RequestException $e) {
            Log::error($e->getMessage());
            return $e->getResponse()->getBody()->getContents();
        }
    }
}
