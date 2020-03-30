<?php

namespace App\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Liip\TestFixturesBundle\Test\FixturesTrait;

class AdminTest extends WebTestCase {
    use FixturesTrait;

    public function testAdminsUserNotAdmin() {
        $fixtures = $this->loadFixtures(array(
            'App\DataFixtures\Tests\UsersFixture',
            'App\DataFixtures\Tests\AgentsFixture',
            'App\DataFixtures\Tests\RapportFixture',
        ));

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
        $fixtures = $this->loadFixtures(array(
            'App\DataFixtures\Tests\UsersFixture',
            'App\DataFixtures\Tests\AgentsFixture',
            'App\DataFixtures\Tests\RapportFixture',
        ));

        $client = $this->makeClientWithCredentials('admin', 'admin');

        $client->request('GET', '/admin');
        $this->assertStatusCode(301, $client);

        $client->request('GET', '/admin/dashboard');
        $this->assertStatusCode(200, $client);

        $client->request('GET', $url);
        $this->assertStatusCode(200, $client);

    }

    public function provideAdminUrls() {
        return [
            ['/admin/app/navire/list'],
            ['/admin/app/navire/create'],
            ['/admin/app/rapport/list'],
            ['/admin/app/rapport/create'],
            ['/admin/app/etablissement/list'],
            ['/admin/app/etablissement/create'],
            ['/admin/app/moyen/list'],
            ['/admin/app/moyen/create'],
            ['/admin/app/zonegeographique/list'],
            ['/admin/app/zonegeographique/create'],
            ['/admin/app/agent/list'],
            ['/admin/app/agent/create'],
            ['/admin/app/serviceinterministeriel/list'],
            ['/admin/app/serviceinterministeriel/create'],
            ['/admin/app/categorieetablissement/list'],
            ['/admin/app/categorieetablissement/create'],
            ['/admin/app/categoriecontroleautre/list'],
            ['/admin/app/categoriecontroleautre/create'],
            ['/admin/app/tache/list'],
            ['/admin/app/tache/create'],
            ['/admin/app/categoriecontrolenavire/list'],
            ['/admin/app/categoriecontrolenavire/create'],
            ['/admin/app/loisir/list'],
            ['/admin/app/loisir/create'],
            ['/admin/app/categoriemoyen/list'],
            ['/admin/app/categoriemoyen/create'],
            ['/admin/app/categoriemethodeciblage/list'],
            ['/admin/app/categoriemethodeciblage/create'],
        ];
    }
}
