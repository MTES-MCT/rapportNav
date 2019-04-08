<?php

namespace App\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase {

    public function setUp() {
    }

    /**
     * Testing home redirect
     */
    public function testHome() {
        $client = $this->makeClient();

        $client->request('GET', '/');
        $this->assertStatusCode(302, $client);
    }

    /**
     * Testing form display and submission
     */
    public function testRapportControlePeche() {
        $client = $this->makeClient();

        //Testing page display
        $crawler = $client->request('GET', '/controle_peche');
        $this->assertStatusCode(200, $client);

        //Testing form submission
        $form = $crawler->selectButton('Enregistrer')->form();
        $form->setValues(['controle_peche[dureeMission]' => '185']);
        $client->submit($form);
        $this->assertStatusCode(302, $client);

    }

    /**
     * Testing displaying all forms
     */
    public function testListForms() {
        $client = $this->makeClient();

        $client->request('GET', '/list_forms');
        $this->assertStatusCode(200, $client);
    }

    /**
     * Testing displaying all submissions
     */
    public function testListSubmissions() {
        $client = $this->makeClient();

        $client->request('GET', '/list_submissions');
        $this->assertStatusCode(200, $client);
    }

    /**
     * Testing displaying KPI
     */
    public function testShowKpi() {
        $client = $this->makeClient();

        $client->request('GET', '/show_kpi');
        $this->assertStatusCode(200, $client);
    }
}
