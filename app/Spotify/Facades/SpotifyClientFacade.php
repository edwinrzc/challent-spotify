<?php

namespace App\Spotify\Facades;

use App\Spotify\Clients\SpotifyClient;
use Illuminate\Support\Facades\Facade;

class SpotifyClientFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return SpotifyClient::class;
    }
}