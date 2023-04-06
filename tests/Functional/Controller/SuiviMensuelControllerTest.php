<?php

namespace App\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;

class SuiviMensuelControllerTest extends WebTestCase {
    
    /** @var AbstractDatabaseTool */
    protected $databaseTool;
    
    public function setUp(): void
    {
        static::bootKernel();
        $this->databaseTool = self::$container->get(DatabaseToolCollection::class)->get();
        $this->databaseTool->loadFixtures(array(
            'App\DataFixtures\Tests\UsersFixture',
            'App\DataFixtures\Tests\AgentsFixture',
            'App\DataFixtures\Tests\RapportFixture',
        ));
    }

    public function testNew() {

        $client = $this->makeAuthenticatedClient();

        $client->request('GET', '/suivimensuel/1234');
        $this->assertStatusCode(404, $client);


        $client->request('GET', '/suivimensuel/01-2020');
        print($this->getStatusMessage());
        $this->assertStatusCode(200, $client);
    }
}
