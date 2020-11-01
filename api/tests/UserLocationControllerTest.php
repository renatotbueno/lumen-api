<?php

class UserLocationControllerTest extends TestCase
{
    public function testGetByUserId()
    {
        $this->get('/users/1/locations');
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'data' => ['*' =>
                [
                    'lat',
                    'lng',
                    'created_at'
                ]
            ]
        ]);
    }

    public function testGetLastLocationByUserId()
    {
        $this->get('/users/1/lastlocation');
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'data' => ['*' =>
                [
                    'lat',
                    'lng',
                    'created_at'
                ]
            ]
        ]);
    }

    public function testStore()
    {
        $bodyRequest = [
            "lat" => "-77.4373815",
            "lng" => "-77.237992"
        ];
        $this->post('/users/1/locations', $bodyRequest, []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'success',
            'message'
        ]);
    }
}
