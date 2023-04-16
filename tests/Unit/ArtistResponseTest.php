<?php

namespace Tests\Unit;

use App\Spotify\Responses\ArtistResponse;
use PHPUnit\Framework\TestCase;

class ArtistResponseTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_get_the_id_attribute()
    {
        $response = new ArtistResponse($this->getArray());

        $this->assertSame("Christina Aguilera", $response->name);
        $this->assertSame("1l7ZsJRRS8wlW3WfJfPfNS", $response->id);
    }

    /**
     * @test
     */
    public function it_cannot_get_the_id_attribute()
    {
        $response = new ArtistResponse([]);

        $this->assertNotSame("Christina Aguilera", $response->name);
        $this->assertNotSame("1l7ZsJRRS8wlW3WfJfPfNS", $response->id);
    }


    protected function getArray()
    {
        return json_decode('{
            "artists": {
                "href": "https://api.spotify.com/v1/search?query=Christina+Aguilera&type=artist&offset=0&limit=20",
                "items": [
                    {
                        "external_urls": {
                            "spotify": "https://open.spotify.com/artist/1l7ZsJRRS8wlW3WfJfPfNS"
                        },
                        "followers": {
                            "href": null,
                            "total": 7508263
                        },
                        "genres": [
                            "dance pop",
                            "pop",
                            "post-teen pop"
                        ],
                        "href": "https://api.spotify.com/v1/artists/1l7ZsJRRS8wlW3WfJfPfNS",
                        "id": "1l7ZsJRRS8wlW3WfJfPfNS",
                        "images": [
                            {
                                "height": 640,
                                "url": "https://i.scdn.co/image/ab6761610000e5eb371cba21c6962a457c550b81",
                                "width": 640
                            },
                            {
                                "height": 320,
                                "url": "https://i.scdn.co/image/ab67616100005174371cba21c6962a457c550b81",
                                "width": 320
                            },
                            {
                                "height": 160,
                                "url": "https://i.scdn.co/image/ab6761610000f178371cba21c6962a457c550b81",
                                "width": 160
                            }
                        ],
                        "name": "Christina Aguilera",
                        "popularity": 78,
                        "type": "artist",
                        "uri": "spotify:artist:1l7ZsJRRS8wlW3WfJfPfNS"
                    }                
                ],
                "limit": 20,
                "next": "https://api.spotify.com/v1/search?query=Christina+Aguilera&type=artist&offset=20&limit=20",
                "offset": 0,
                "previous": null,
                "total": 150
            }
        }',true);
    }
}
