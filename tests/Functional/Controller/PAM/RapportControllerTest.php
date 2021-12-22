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
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW'   => 'admin',
        ]);
    }

    public function testDraftRapport()
    {

       $rapport = new PamRapport();
       $rapport->setNumber('TEST' . uniqid());
        $container = self::$container;

        /** @var SerializerInterface $serializer */
        $serializer = $container->get(SerializerInterface::class);
        $json = $serializer->serialize($rapport, 'json');

        $this->client->request(
            'POST',
            '/api/pam/rapport/draft',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            $json
        );

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

    }

}
