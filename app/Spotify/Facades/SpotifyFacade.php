<?php

namespace App\Spotify\Facades;

use App\Spotify\Spotify;
use Illuminate\Support\Facades\Facade;

class SpotifyFacade extends Facade
{
    public static function getFacadeAccessor()
    {
        return Spotify::class;
    }
}