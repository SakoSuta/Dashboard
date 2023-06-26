<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class AuthService
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client([
            // 'base_uri' => 'http://localhost:3000/api/auth/',
            'base_uri' => config('app.guzzle_api_url').'/auth/',
            'headers' => [
                'Accept' => 'application/json',
            ],
            'verify' => false,
        ]);
    }

    public function login(array $credentials): array
    {
        try {
            // var_dump($credentials);
            // die();
            $response = $this->client->post('login', [
                'json' => $credentials,
            ]);
            $body = json_decode($response->getBody()->getContents(), true);
            return ['success' => true, 'token' => $body['token'], 'data' => $body['user']];
        } catch (GuzzleException $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function getUserByToken(string $token): array
    {
        try{
            $response = $this->client->get('http://localhost:3000/api/auth/me/', [
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                ],
            ]);
            $body = json_decode($response->getBody()->getContents(), true);
            // var_dump($body);
            // die();
            return ['success' => true, 'data' => $body];
        }catch (GuzzleException $e){
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}