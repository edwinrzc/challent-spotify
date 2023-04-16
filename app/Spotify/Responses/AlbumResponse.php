<?php

namespace App\Spotify\Responses;


class AlbumResponse
{


    protected $attributes = [];
    
    
    public function __construct(array $response)
    {        
        $this->build($response);        
    }


    /**
     * @param array $response
     * @return mixed Model|null
     */
    protected function build(array $response)
    {
        if( array_key_exists('items', $response) ){
            foreach($response['items'] as $value){                
                $this->buildArray($value);
            }
        }
    }
    
    
    public function fill(array $attributes = [])
    {
        array_push($this->attributes, $attributes);
        return $this;
    }


    public function getAttributes()
    {
        return $this->attributes;
    }


    protected function buildArray(array $item )
    {
        $result = [];
        $arrayAllowed = $this->arrayAllowed();
        foreach($item as $key => $value){
            if(isset($arrayAllowed[$key])){
                $result[$arrayAllowed[$key]] = $key == 'images'? $value[0] : $value;
            }
        }

        $this->fill($result);
    }


    protected function arrayAllowed()
    {
        return [
            'name' => 'name',
            'release_date' => 'released',
            'total_tracks' => 'tracks',
            'images' => 'cover'
        ];
    }

}