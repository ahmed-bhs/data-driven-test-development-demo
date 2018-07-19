<?php

namespace App\Tests\Team;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class Test extends WebTestCase
{
    const SLUG_ENTITY = 'team';

    const SLUG_ACTION = 'create';

    private $client;

    public function setUp()
    {
        $this->client = static::createClient();
    }
    public function tearDown()
    {
        $this->client = null;
    }

    /**
     * @dataProvider data
     * @test
     */
    public function create_POST_200($team)
    {
        $this->client->request(
            'POST',
            '/' . self::SLUG_ENTITY . '/' . self::SLUG_ACTION,
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($team)
        );

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
    }

    public function data()
    {
        return json_decode(file_get_contents(__DIR__ . '/data.json'), true);
    }
}
