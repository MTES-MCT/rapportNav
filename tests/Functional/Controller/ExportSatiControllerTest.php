<?php

namespace App\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Liip\TestFixturesBundle\Test\FixturesTrait;

class ExportSatiControllerTest extends WebTestCase {
    use FixturesTrait;

    public function testInspectionMer() {
        $fixtures = $this->loadFixtures(array(
            'App\DataFixtures\Tests\UsersFixture',
            'App\DataFixtures\Tests\AgentsFixture',
            'App\DataFixtures\Tests\RapportFixture',
        ));

        $client = $this->makeAuthenticatedClient();

        $client->request('GET', '/sati/inspection_mer/1234');
        $this->assertStatusCode(404, $client);

        $id = $fixtures->getReferenceRepository()->getReference("rapportNavPro")->getId();


        $client->request('GET', '/sati/inspection_mer/'.$id);
        $this->assertStatusCode(200, $client);
    }
}
