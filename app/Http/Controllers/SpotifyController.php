<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpotifyRequest;
use App\Spotify\Facades\SpotifyFacade as Spotify;
use Illuminate\Http\Request;

class SpotifyController extends Controller
{
    

    public function albums(SpotifyRequest $request)
    {
        try {            

            $response = $request->searchAlbums();
            return response()->json([
                'albums' => $response->getAttributes()
            ],200);
            
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage()
            ],500);
        }
    }
}
