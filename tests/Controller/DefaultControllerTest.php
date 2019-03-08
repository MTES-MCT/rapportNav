<?php

namespace App\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use App\DataFixtures\FormFixture;

class DefaultControllerTest extends WebTestCase {

    public function setUp() {
        $this->loadFixtures([
            FormFixture::class,
        ]);
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
     * Testing form display
     */
    public function testShowForm() {
        $client = $this->makeClient();

        $client->request('GET', '/show_form/1');
        $this->assertStatusCode(200, $client);

        $client->request('GET', '/show_form/42');
        $this->assertStatusCode(404, $client);
    }

    /**
     * Testing submission and submission edit
     */
    public function testResults() {
        $client = $this->makeClient();

        //Testing new submission
        $client->request(
            'POST',
            '/submit/1',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"question1": "10-12-2019"}');

        $this->assertStatusCode(200, $client);

        $this->assertSame('{"status":"success","data":""}', $client->getResponse()->getContent());

        $client->request(
            'POST',
            '/submit/1/1',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"question1": "12-12-2019"}');

        $this->assertStatusCode(200, $client);

        $this->assertSame('{"status":"success","data":""}', $client->getResponse()->getContent());

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
     * Testing displaying all forms
     */
    public function testListForms() {
        $client = $this->makeClient();

        $client->request('GET', '/list_forms');
        $this->assertStatusCode(200, $client);
    }
}
