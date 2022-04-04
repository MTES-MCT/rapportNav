<?php

namespace App\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;

class DefaultControllerTest extends WebTestCase {
    
    /** @var AbstractDatabaseTool */
    protected $databaseTool;
    
    private $fixtures;
    
    public function setUp(): void {
        static::bootKernel();
        $this->databaseTool = self::$container->get(DatabaseToolCollection::class)->get();
        $this->fixtures = $this->databaseTool->loadFixtures(array(
            'App\DataFixtures\Tests\UsersFixture',
            'App\DataFixtures\Tests\RapportFixture',
        ));
    }

    /**
     * Testing home redirect
     */
    public function testHome() {
        
$functional = 0;
        $client = $this->makeAuthenticatedClient();

        $client->request('GET', '/');
        $this->assertStatusCode(302, $client);
    }

    /**
     * Testing form display and submission
     */
    public function testRapport() {

        $client = $this->makeAuthenticatedClient();

        //Testing page display
        $client->request('GET', '/rapport');
        $this->assertStatusCode(200, $client);

        //Testing edit display
        $id = $this->fixtures->getReferenceRepository()->getReference("rapportNavPro")->getId();
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
