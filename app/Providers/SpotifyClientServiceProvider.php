<?php

namespace App\Providers;

use App\Spotify\Clients\SpotifyClient;
use Illuminate\Support\ServiceProvider;

class SpotifyClientServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SpotifyClient::class, function () {
            return new SpotifyClient;
        });
    }
}
