<?php

namespace App\Tests\Unit\Service\PAM;

use App\DataFixtures\Tests\AgentsFixture;
use App\DataFixtures\Tests\ServicesFixture;
use App\DataFixtures\Tests\UsersFixture;
use App\Security\Tests\SecurityTrait;
use App\Service\PAM\PamEquipageService;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AgentAutocompleteTest extends KernelTestCase {

    use FixturesTrait;
    use SecurityTrait;

    protected function setUp(): void {
        $this->loadFixtures([
            ServicesFixture::class,
            UsersFixture::class,
            AgentsFixture::class,
        ]);
        self::bootKernel();
        $this->login('ROLE_USER', true);
    }

    public function testListAllSuccess(): void
    {
        $container = self::$container;
        $service = $container->get(PamEquipageService::class);
        $agents = $service->autocomplete();
        $this->assertCount(2, $agents);
    }

    public function testWithFullNameNoResult(): void
    {
        $container = self::$container;
        $service = $container->get(PamEquipageService::class);
        $agents = $service->autocomplete('Jane Doe');
        $this->assertCount(0, $agents);
    }

    public function testWithFirstNameSuccess(): void
    {
        $container = self::$container;
        $service = $container->get(PamEquipageService::class);
        $agents = $service->autocomplete('Alfred');
        $this->assertCount(1, $agents);
        $this->assertEquals('Alfred', $agents[0]->getPrenom());
        $this->assertEquals('De Musset', $agents[0]->getNom());
    }

    public function testWithLastNameSuccess(): void
    {
        $container = self::$container;
        $service = $container->get(PamEquipageService::class);
        $agents = $service->autocomplete('De Musset');
        $this->assertCount(1, $agents);
        $this->assertEquals('Alfred', $agents[0]->getPrenom());
        $this->assertEquals('De Musset', $agents[0]->getNom());
    }

    public function testWithFullNameSuccess(): void
    {
        $container = self::$container;
        $service = $container->get(PamEquipageService::class);
        $agents = $service->autocomplete('Marceline Desbordes-Valmore');
        $this->assertCount(1, $agents);
        $this->assertEquals('Marceline', $agents[0]->getPrenom());
        $this->assertEquals('Desbordes-Valmore', $agents[0]->getNom());
    }

    public function testWithFullNameUpperCaseSuccess(): void
    {
        $container = self::$container;
        $service = $container->get(PamEquipageService::class);
        $agents = $service->autocomplete('MARCELINE DESBORDES-VALMORE');
        $this->assertCount(1, $agents);
        $this->assertEquals('Marceline', $agents[0]->getPrenom());
        $this->assertEquals('Desbordes-Valmore', $agents[0]->getNom());
    }
}
