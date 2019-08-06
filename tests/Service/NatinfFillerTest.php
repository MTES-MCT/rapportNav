<?php

namespace App\Tests\Service;

use App\Entity\Natinf;
use App\Service\NatinfFiller;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class NatinfFillerTest extends TestCase {
    public function testFromArray() {
        $fakeEm = $this->createMock(EntityManagerInterface::class);
        $natinfFiller = new NatinfFiller($fakeEm, "http://localhost:8090/api/");

        $data = ["32208", "00000"];
        $results = $natinfFiller->fromArray($data, true);

        $this->assertEquals(2, count($results));
        $this->assertTrue(is_a($results['32208'], Natinf::class));
        $this->assertTrue(is_a($results['00000'], Natinf::class));
        $this->assertEquals(32208, $results['32208']->getNumero());
        $this->assertEquals(0, $results['00000']->getNumero());
    }
}
