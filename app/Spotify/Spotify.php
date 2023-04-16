<?php

namespace App\Spotify;

use App\Spotify\Facades\SpotifyClientFacade as SpotifyClient;
use App\Spotify\Responses\AlbumResponse;
use App\Spotify\Responses\ArtistResponse;
use Exception;

class Spotify
{

    const SPOTIFY_API_URL = 'https://api.spotify.com/v1';

    /**
     * @var string
     */
    private $token;


    public function __construct(string $token)
    {
        $this->token = $token;
    }


    /**
     * @method get
     * @param string $endpoint, 
     * @param array $params
     * @throws Exception
     */
    public function get(string $endpoint, array $params = []): array
    {
        try {
            $response = SpotifyClient::get(self::SPOTIFY_API_URL.$endpoint.'?'.http_build_query($params), [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accepts' => 'application/json',
                    'Authorization' => 'Bearer '.$this->token,
                ],
            ]);
        } catch (Exception $e) {
            $status = $e->getCode();
            $message = $e->getMessage();

            throw new Exception($message, $status);
        }

        return json_decode((string) $response->getBody(), true);
    }


    /**
     * @method get
     * @return ArtistInterface|mixed
     */
    public function getArtistId(array $params = []): mixed
    {        
        $response = $this->get('/search', $params);        
        $artistResponse = new ArtistResponse($response);
        return new Artists($artistResponse);
    }



    public function getArtistAlbums(string $id, $offset = 0, $limit = 20)
    {
        
        $response = $this->get("/artists/{$id}/albums", [
            'limit' => $limit,
            'offset'=> $offset
        ]);

        return new AlbumResponse($response);
    }

}