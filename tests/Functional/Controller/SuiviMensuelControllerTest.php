<?php

namespace App\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Liip\TestFixturesBundle\Test\FixturesTrait;

class SuiviMensuelControllerTest extends WebTestCase {
    use FixturesTrait;

    public function testNew() {
        $fixtures = $this->loadFixtures(array(
            'App\DataFixtures\Tests\UsersFixture',
            'App\DataFixtures\Tests\AgentsFixture',
            'App\DataFixtures\Tests\RapportFixture',
        ));

        $client = $this->makeAuthenticatedClient();

        $client->request('GET', '/suivimensuel/1234');
        $this->assertStatusCode(404, $client);


        $client->request('GET', '/suivimensuel/01-2020');
        $this->assertStatusCode(200, $client);
    }
}
