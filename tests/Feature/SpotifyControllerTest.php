<?php

namespace Tests\Feature;

use Tests\TestCase;

class SpotifyControllerTest extends TestCase
{
    
    /**
     * @test
     */
    function it_can_get_albums_for_band_name_parameter()
    {
        
        $path = http_build_query([
            'q'=>"Metalica"
        ]);

        $response = $this->get('api/v1/albums?'.$path); 
        $response->assertJsonFragment($this->getJsonExmple());
    }



    /**
     * @test
     */
    function the_parameter_is_required()
    {
        
        $path = http_build_query([
            'q'=>""
        ]);
        $response = $this->get('api/v1/albums?'.$path); 

        $response->assertStatus(422);
        $response->assertSimilarJson(
            json_decode('{"errors":{"q":["The q field is required."]},"status":true}',true)
        );
    }


    protected function getJsonExmple()
    {
        return json_decode('{
            "cover": {
                "height": 640,
                "url": "https:\/\/i.scdn.co\/image\/ab67616d0000b273cf2420c5c82d351496e8fd9e",
                "width": 640
            },
            "name": "72 Seasons",
            "released": "2023-04-14",
            "tracks": 12
        }',true);
    }
}
