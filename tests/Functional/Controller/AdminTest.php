<?php

namespace App\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;

class AdminTest extends WebTestCase {
    
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
        
    public function testAdminsUserNotAdmin() {
        
        $client = $this->makeAuthenticatedClient();

        $client->request('GET', '/admin');
        $this->assertStatusCode(301, $client);

        $client->request('GET', '/admin/dashboard');
        $this->assertStatusCode(200, $client);

        $client->request('GET', '/admin/app/navire/list');
        $this->assertStatusCode(403, $client);

    }

    /**
     * @dataProvider provideAdminUrls
     */
    public function testAdminsUserAdmin($url) {

        $client = $this->makeClientWithCredentials('admin', 'admin');

        $client->request('GET', $url.'/list');
        $this->assertStatusCode(200, $client);

        $client->request('GET', $url.'/create');
        $this->assertStatusCode(200, $client);

    }

    public function provideAdminUrls() {
        return [
            ['/admin/app/navire'],
            ['/admin/app/rapport'],
            ['/admin/app/etablissement'],
            ['/admin/app/moyen'],
            ['/admin/app/zonegeographique'],
            ['/admin/app/agent'],
            ['/admin/app/serviceinterministeriel'],
            ['/admin/app/categorieetablissement'],
            ['/admin/app/categoriecontroleautre'],
            ['/admin/app/tache'],
            ['/admin/app/categorieusagenavire'],
            ['/admin/app/categoriecontrolenavire'],
            ['/admin/app/loisir'],
            ['/admin/app/categoriemoyen'],
            ['/admin/app/categoriemethodeciblage'],
            ['/admin/app/pam-categorypamcontrole'],
            ['/admin/app/pam-categorypamindicateur'],
            ['/admin/app/pam-categorypammission'],
            ['/admin/app/fonctionagent'],
            ['/admin/app/fonctionparticuliereagent'],
            ['/admin/app/pam-pamrapport'],
        ];
    }
}
