<?php

namespace App\Tests\Controller;

use App\Controller\DraftController;
use App\DataFixtures\Local\UsersFixture;
use Liip\FunctionalTestBundle\Test\WebTestCase;

class DraftControllerTest extends WebTestCase {

    public function setUp() {
        $this->loadFixtures(['App\DataFixtures\Tests\DraftsFixture']);
    }

    public function testSaveNew() {
        $client = $this->makeClient(true);

        $client->request('POST', '/rapport/controle_a_bord/draft');
        $this->assertStatusCode(400, $client);

        $client->request('POST', '/rapport/controle_a_bord/draft', [], [],
            ['CONTENT_TYPE' => "application/json"],
            "{}");

        $this->assertStatusCode(302, $client);
    }

    public function testEdit() {
        $client = $this->makeClient(true);

        $client->request('GET', 'rapport/controle_a_bord/draft/1');
        $this->assertStatusCode(200, $client);
    }

    public function testDelete() {
        $client = $this->makeClient(true);

        $client->request('DELETE', 'rapport/controle_a_bord/draft/1');
        $this->assertStatusCode(302, $client);
    }
}
