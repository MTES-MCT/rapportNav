<?php

namespace App\Tests\Unit\Service\PAM;

use App\DataFixtures\Tests\PAM\ControleTypeFixture;
use App\DataFixtures\Tests\PAM\DraftFixture;
use App\DataFixtures\Tests\PAM\IndicateurTypeFixture;
use App\DataFixtures\Tests\PAM\MissionTypeFixture;
use App\DataFixtures\Tests\PAM\RapportFixture;
use App\DataFixtures\Tests\UsersFixture;
use App\Repository\PAM\PamRapportRepository;
use App\Service\PAM\ExportService;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ExportFilterTest extends KernelTestCase {

    use FixturesTrait;

    protected function setUp(): void {
        $this->loadFixtures([
            UsersFixture::class,
            MissionTypeFixture::class,
            IndicateurTypeFixture::class,
            ControleTypeFixture::class,
            RapportFixture::class,
            DraftFixture::class
        ]);
        self::bootKernel();
    }

    public function testTelechargement3MoisRapportAEMValide()
    {
        $container = self::$container;
        $repository = $container->get(PamRapportRepository::class);
        $firstDate = new \DateTime('01/01/2022');
        $lastDate = new \DateTime('03/01/2022');
        $rapports = $repository->findByDateRange($firstDate, $lastDate);

        $this->assertCount(3, $rapports);
        $this->assertEquals('MED-2022-1', $rapports[0]->getId());
        $this->assertEquals('MED-2022-2', $rapports[1]->getId());
        $this->assertEquals('MED-2022-3', $rapports[2]->getId());
    }

    public function testTelechargement1MoisRapportAEMValide()
    {
        $container = self::$container;
        $repository = $container->get(PamRapportRepository::class);
        $firstDate = new \DateTime('01/01/2022');
        $lastDate = new \DateTime('01/31/2022');
        $rapports = $repository->findByDateRange($firstDate, $lastDate);

        $this->assertCount(1, $rapports);
        $this->assertEquals('MED-2022-1', $rapports[0]->getId());
    }


}
