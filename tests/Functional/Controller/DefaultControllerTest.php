<?php

namespace App\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Liip\TestFixturesBundle\Test\FixturesTrait;

class DefaultControllerTest extends WebTestCase {
    use FixturesTrait;

    /**
     * Testing home redirect
     */
    public function testHome() {
        $this->loadFixtures(array(
            'App\DataFixtures\Tests\UsersFixture',
        ));
$functional = 0;
        $client = $this->makeAuthenticatedClient();

        $client->request('GET', '/');
        $this->assertStatusCode(302, $client);
    }

    /**
     * Testing form display and submission
     */
    public function testRapport() {
        $fixtures = $this->loadFixtures(array(
            'App\DataFixtures\Tests\UsersFixture',
            'App\DataFixtures\Tests\RapportFixture',
        ));

        $client = $this->makeAuthenticatedClient();

        //Testing page display
        $client->request('GET', '/rapport');
        $this->assertStatusCode(200, $client);

        //Testing edit display
        $id = $fixtures->getReferenceRepository()->getReference("rapportNavPro")->getId();
        $client->request('GET', '/rapport/edit/' . $id);
        $this->assertStatusCode(200, $client);

    }

    /**
     * Testing displaying all forms
     */
    public function testListForms() {
        $client = $this->makeAuthenticatedClient();

        $client->request('GET', '/list_forms');
        $this->assertStatusCode(200, $client);
    }

    /**
     * Testing displaying all submissions
     */
    public function testListSubmissions() {
        $client = $this->makeAuthenticatedClient();

        $client->request('GET', '/list_submissions');
        $this->assertStatusCode(200, $client);

        $client->request('GET', '/list_submissions/01-01-2020');
        $this->assertStatusCode(200, $client);
    }

    /**
     * Testing displaying KPI
     */
    public function testShowKpi() {
        $client = $this->makeAuthenticatedClient();

        $client->request('GET', '/show_kpi');
        $this->assertStatusCode(200, $client);
    }
}
