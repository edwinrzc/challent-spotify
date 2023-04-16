<?php

namespace App\Spotify;

use App\Spotify\Facades\SpotifyClientFacade as SpotifyClient;
use Illuminate\Support\Facades\Cache;
use Exception;

class Auth
{

    private const SPOTIFY_API_TOKEN_URL = 'https://accounts.spotify.com/api/token';

    private $clientId;
    private $clientSecret;

    public function __construct($clientId, $clientSecret)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    /**
     * Generate the access token.
     *
     * @throws Exception
     */
    private function generateAccessToken(): void
    {
        try {
            $response = SpotifyClient::post(self::SPOTIFY_API_TOKEN_URL, [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Accepts' => 'application/json',
                    'Authorization' => 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret),
                ],
                'form_params' => [
                    'grant_type' => 'client_credentials',
                ],
            ]);
        } catch (\Exception $e) {
            $status = $e->getCode();

            throw new Exception($e->getMessage(), $status);
        }

        $body = json_decode((string) $response->getBody());
        
        Cache::remember('AccessToken', $body->expires_in, function () use ($body) {
            return $body->access_token;
        });
    }

    /**
     * Get the access token.
     *
     * @return string
     * @throws Exception
     */
    public function getAccessToken(): string
    {
        if (!Cache::has('AccessToken')) {
            $this->generateAccessToken();
        }

        return Cache::get('AccessToken');
    }
}
