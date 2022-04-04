<?php

namespace App\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;

class ExportSatiControllerTest extends WebTestCase {
    
    /** @var AbstractDatabaseTool */
    protected $databaseTool;
    
    public function setUp(): void
    {
        static::bootKernel();
        $this->databaseTool = self::$container->get(DatabaseToolCollection::class)->get();
    }
    
    public function testInspectionMer() {
        $fixtures = $this->databaseTool->loadFixtures(array(
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
