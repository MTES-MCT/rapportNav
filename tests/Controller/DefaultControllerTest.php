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

        $client = $this->makeAuthenticatedClient();

        $client->request('GET', '/');
        $this->assertStatusCode(302, $client);
    }

    /**
     * Testing form display and submission
     */
    public function testRapportCreate() {
        $this->loadFixtures(array(
            'App\DataFixtures\Tests\UsersFixture',
        ));

        $client = $this->makeAuthenticatedClient();

        //Testing page display
        $crawler = $client->request('GET', '/rapport');
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
