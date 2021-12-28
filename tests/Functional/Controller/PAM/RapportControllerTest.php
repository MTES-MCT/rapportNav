<?php

namespace App\Tests\Functional\Controller\PAM;

use App\DataFixtures\Tests\PAM\ControleTypeFixture;
use App\DataFixtures\Tests\PAM\IndicateurTypeFixture;
use App\DataFixtures\Tests\PAM\MissionTypeFixture;
use App\DataFixtures\Tests\UsersFixture;
use App\Entity\PAM\PamDraft;
use App\Entity\PAM\PamRapport;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Serializer\SerializerInterface;

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
    }

    public function testDraftRapportSuccess()
    {
        $json =$this->jsonReader('body-test-draft-success.json');
        $this->sendPostRequest('/rapport/draft', $json);

        $res_array = (array)json_decode($this->client->getResponse()->getContent());
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $this->assertNotNull($res_array['id']);

    }

    public function testDraftMissingStartDateTimeError400()
    {
        $json = $this->jsonReader('body-test-draft-missing-startdatetime.json');
        $this->sendPostRequest('/rapport/draft', $json);

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
