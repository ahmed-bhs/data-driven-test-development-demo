<?php

namespace App\Tests\Team\Create;

use App\Tests\TokenAuthenticatedWebTestCase;

class HttpStatus200Test extends TokenAuthenticatedWebTestCase
{
    /**
     * @dataProvider data
     * @test
     */
    public function http_status_200($name, $location, $stadium, $season)
    {
        $team = [
            'name'     => $name,
            'location' => $location,
            'stadium'  => $stadium,
            'season'   => $season,
        ];

        $client = static::createClient();

        $client->request(
            'POST',
            'team/create',
            [],
            [],
            [
                'HTTP_AUTHORIZATION' => 'Bearer '.self::$accessToken,
                'CONTENT_TYPE'       => 'application/json',
            ],
            json_encode($team)
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function data()
    {
        $data = [];
        $teams = json_decode(file_get_contents(__DIR__.'/data/http_status_200.json'))->httpBody;
        foreach ($teams as $team) {
            $data[] = [
                $team->name,
                $team->location,
                $team->stadium,
                $team->season,
            ];
        }

        return $data;
    }
}
