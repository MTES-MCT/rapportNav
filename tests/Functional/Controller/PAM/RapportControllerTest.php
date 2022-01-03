<?php

namespace App\Tests\Functional\Controller\PAM;

use App\DataFixtures\Tests\PAM\ControleTypeFixture;
use App\DataFixtures\Tests\PAM\IndicateurTypeFixture;
use App\DataFixtures\Tests\PAM\MissionTypeFixture;
use App\DataFixtures\Tests\UsersFixture;
use App\Repository\PAM\PamRapportRepository;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RapportControllerTest extends WebTestCase {

    use FixturesTrait;

    private $client;

    protected function setUp(): void {
        $this->loadFixtures([
            UsersFixture::class,
            MissionTypeFixture::class,
            IndicateurTypeFixture::class,
            ControleTypeFixture::class
        ]);

        $this->client = static::createClient([], [
            'PHP_AUTH_USER' => 'alfred.de-musset',
            'PHP_AUTH_PW'   => '1234',
        ]);

        self::bootKernel();
    }

    public function testRapportSaveSuccess()
    {
        $json = $this->jsonReader('body-test-rapport-success.json');
        $this->sendPostRequest('/rapport', $json);
        $res_array = (array)json_decode($this->client->getResponse()->getContent());
        $container = self::$container;
        $rapport = $container->get(PamRapportRepository::class)->find($res_array['id']);

        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());
        $this->assertStringContainsString('MED' ,$res_array['id']);
        $this->assertNotNull($rapport);
    }

    public function testRapportMissingMandatoryInfo400Error()
    {
        $json = $this->jsonReader('body-test-rapport-missing-mandatory-info.json');
        $this->sendPostRequest('/rapport', $json);

        $this->assertEquals(400, $this->client->getResponse()->getStatusCode());
    }


    private function sendPostRequest(string $url, string $body)
    {
        $this->client->request(
            'POST',
            '/api/pam' . $url,
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            $body
        );
    }


    private function jsonReader(string $fileName): string
    {
        $path = __DIR__ . '/dist/' . $fileName;
        $file = fopen($path, "r") or die("Unable to open file!");
        $json = (fread($file, filesize($path)));
        fclose($file);

        return$json;
    }

}
