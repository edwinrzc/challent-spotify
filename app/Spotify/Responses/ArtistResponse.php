<?php

namespace App\Spotify\Responses;

use App\Spotify\Model;

class ArtistResponse extends Model
{



    public function __construct(array $response)
    {        
        parent::__construct($this->build($response) ?? []);
    }

    /**
     * @param array $response
     * @return mixed Model|null
     */
    protected function build(array $response)
    {
        if( array_key_exists('artists', $response) ){
            foreach($response['artists']['items'] as $value){
                return $value;
            }
        }
    }

    
}