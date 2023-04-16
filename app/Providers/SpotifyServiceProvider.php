<?php

namespace App\Providers;

use App\Spotify\Auth;
use App\Spotify\Spotify;
use Illuminate\Support\ServiceProvider;

class SpotifyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        
        $this->app->singleton(Auth::class, function () {
            
            $clientId = config('spotify.auth.client_id');
            $clientSecret = config('spotify.auth.client_secret');

            return new Auth($clientId, $clientSecret);
        });


        $this->app->bind(Spotify::class, function(){
            $token = $this->app->make(Auth::class)->getAccessToken();
            return new Spotify($token);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/spotify.php', 'spotify');

        $this->publishes([
            __DIR__.'/../../config/spotify.php' => config_path('spotify.php'),
        ]);
    }
}
