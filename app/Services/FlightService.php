<?php

namespace App\Services;

use GuzzleHttp\Client;

class FlightService {
    const BASE_URI = 'http://prova.123milhas.net/';

    /**
     * @var Client
     */
    private $client;

    /**
     * FlightService constructor.
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => self::BASE_URI,
            'verify' => false
        ]);
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function fetchFlights(): \Illuminate\Support\Collection
    {
        $response = $this->client->get('api/flights');
        return collect(json_decode($response->getBody(), true));
    }
}
