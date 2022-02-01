<?php

namespace App\Tests\Functional\Controller\PAM;

use App\DataFixtures\Tests\PAM\ControleTypeFixture;
use App\DataFixtures\Tests\PAM\DraftFixture;
use App\DataFixtures\Tests\PAM\IndicateurTypeFixture;
use App\DataFixtures\Tests\PAM\MissionTypeFixture;
use App\DataFixtures\Tests\PAM\RapportFixture;
use App\DataFixtures\Tests\UsersFixture;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

// TODO : Faire passer les tests fonctionnels avec PhpOffice
/**class ExportXSLControllerTest extends WebTestCase {

    use FixturesTrait;

    private $client;

    protected function setUp(): void {
        $this->loadFixtures([
            UsersFixture::class,
            MissionTypeFixture::class,
            IndicateurTypeFixture::class,
            ControleTypeFixture::class,
            RapportFixture::class,
            DraftFixture::class
        ]);

        $this->client = static::createClient([], [
            'PHP_AUTH_USER' => 'alfred.de-musset',
            'PHP_AUTH_PW'   => '1234',
        ]);

        self::bootKernel();
    }

    /**
     * L’utilisateur se rend sur l'endpoint valide afin de télécharger le fichier.
     * Il y renseigne en paramètre à l’URL le numéro de rapport.
     */
  /**  public function testSuccess()
    {
        $current = new \DateTime();
        $id = 'MED-' . $current->format('Y') . '-1';
        $this->sendRequest('/indicateurs/' . $id, null, 'GET');
        $response = $this->client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/vnd.ms-excel', $response->headers->get('Content-Type'));
    }

    /**
     * L’utilisateur se rend sur l'endpoint sans y préciser un numéro de rapport dans l’URL
     */
 /**   public function testRapportNumberMissing()
    {
        $this->sendRequest('/indicateurs', null, 'GET');
        $response = $this->client->getResponse();
        $this->assertEquals(400, $response->getStatusCode());
        $this->assertStringContainsString('Le numéro de rapport est manquant.', $response->getContent());
    }

    /**
     * L’utilisateur se rend sur l'endpoint en y précisant un numéro de rapport introuvable
     */
 /**   public function testRapportNumberNotFound()
    {
        $current = new \DateTime();
        $id = 'MED-' . $current->format('Y') . '-80';
        $this->sendRequest('/indicateurs/' . $id, null, 'GET');
        $response = $this->client->getResponse();
        $this->assertEquals(404, $response->getStatusCode());
        $this->assertStringContainsString('Aucun rapport n’a été trouvé avec le numéro 80', $response->getContent());
    }


    private function sendRequest(string $url, string $body = null, $method = 'POST')
    {
        $this->client->request(
            $method,
            '/api/pam/export' . $url,
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            $body
        );
    }
}
**/
