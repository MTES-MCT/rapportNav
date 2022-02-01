<?php

namespace App\Tests\Unit\Service\PAM;

use App\DataFixtures\Tests\PAM\ControleTypeFixture;
use App\DataFixtures\Tests\PAM\DraftFixture;
use App\DataFixtures\Tests\PAM\IndicateurTypeFixture;
use App\DataFixtures\Tests\PAM\MissionTypeFixture;
use App\DataFixtures\Tests\PAM\RapportFixture;
use App\DataFixtures\Tests\UsersFixture;
use App\Repository\PAM\PamDraftRepository;
use App\Repository\PAM\PamIndicateurRepository;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ExportOdsTest extends KernelTestCase {

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

    public function testAllIndicateurList()
    {
        $current = new \DateTime();
        $id = 'MED-' . $current->format('Y') . '-1';
        $container = self::$container;
        $repository = $container->get(PamIndicateurRepository::class);
        $indicateurs = $repository->findAllByRapport($id);

        $this->assertCount(10, $indicateurs);
        foreach($indicateurs as $indicateur) {
            $this->assertEquals(10, $indicateur->getPrincipale());
            $this->assertEquals(22, $indicateur->getSecondaire());
        }
    }

    public function testAllIndicateurDraftList()
    {
        $current = new \DateTime();
        $id = 'MED-' . $current->format('Y') . '-2';
        $container = static::$container;
        $repository = $container->get(PamDraftRepository::class);
        $indicateurs = $repository->findAllIndicateursByRapport($id);

        $this->assertCount(10, $indicateurs);
        foreach($indicateurs as $indicateur) {
            $this->assertEquals(44, $indicateur->getPrincipale());
            $this->assertEquals(8, $indicateur->getSecondaire());
        }
    }

}
