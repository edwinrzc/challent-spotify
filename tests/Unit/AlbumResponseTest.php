<?php

namespace Tests\Unit;

use App\Spotify\Responses\AlbumResponse;
use PHPUnit\Framework\TestCase;

class AlbumResponseTest extends TestCase
{

    /**
     * @test
     */
    public function it_can_get_the_id_attribute()
    {
        $response = new AlbumResponse($this->getArray());
        $attributes = $response->getAttributes();

        $this->assertCount(1, $attributes);
        $this->assertSame("Metallica (Remastered 2021)", $attributes[0]['name']);
    }

    /**
     * @test
     */
    public function it_cannot_get_the_id_attribute()
    {
        $response = new AlbumResponse([]);
        $attributes = $response->getAttributes();

        $this->assertCount(0, $attributes);
        $this->assertNotSame("Metallica (Remastered 2021)", $attributes);
    }


    protected function getArray()
    {
        return json_decode('{
            "href": "https:\/\/api.spotify.com\/v1\/artists\/2ye2Wgw4gimLv2eAKyk1NB\/albums?offset=0&limit=20&include_groups=album,single,compilation,appears_on",
            "items": [        
                {
                    "album_group": "album",
                    "album_type": "album",
                    "artists": [
                        {
                            "external_urls": {
                                "spotify": "https:\/\/open.spotify.com\/artist\/2ye2Wgw4gimLv2eAKyk1NB"
                            },
                            "href": "https:\/\/api.spotify.com\/v1\/artists\/2ye2Wgw4gimLv2eAKyk1NB",
                            "id": "2ye2Wgw4gimLv2eAKyk1NB",
                            "name": "Metallica",
                            "type": "artist",
                            "uri": "spotify:artist:2ye2Wgw4gimLv2eAKyk1NB"
                        }
                    ],
                    "external_urls": {
                        "spotify": "https:\/\/open.spotify.com\/album\/3dck2tBxGfxj9m3CguDgjb"
                    },
                    "href": "https:\/\/api.spotify.com\/v1\/albums\/3dck2tBxGfxj9m3CguDgjb",
                    "id": "3dck2tBxGfxj9m3CguDgjb",
                    "images": [
                        {
                            "height": 640,
                            "url": "https:\/\/i.scdn.co\/image\/ab67616d0000b27376c60d2128c8e4649b85f2b2",
                            "width": 640
                        },
                        {
                            "height": 300,
                            "url": "https:\/\/i.scdn.co\/image\/ab67616d00001e0276c60d2128c8e4649b85f2b2",
                            "width": 300
                        },
                        {
                            "height": 64,
                            "url": "https:\/\/i.scdn.co\/image\/ab67616d0000485176c60d2128c8e4649b85f2b2",
                            "width": 64
                        }
                    ],
                    "name": "Metallica (Remastered 2021)",
                    "release_date": "2021-09-10",
                    "release_date_precision": "day",
                    "total_tracks": 12,
                    "type": "album",
                    "uri": "spotify:album:3dck2tBxGfxj9m3CguDgjb"
                }
            ]
        }',true);
    }
}
