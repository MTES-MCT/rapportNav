<?php

namespace App\Tests\Unit\Service;

use App\Entity\Natinf;
use App\Service\NatinfFiller;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class NatinfFillerTest extends TestCase {
    public function testFromArray() {
        $fakeRepo = $this->createMock(ObjectRepository::class);
        $fakeRepo->expects($this->any())
            ->method('findOneBy')
            ->willReturn(null);
        $fakeEm = $this->createMock(EntityManagerInterface::class);
        $fakeEm->expects($this->any())
            ->method('getRepository')
            ->willReturn($fakeRepo);
        $natinfFiller = new NatinfFiller($fakeEm, "http://localhost:8090/api/");

        $data = ["32208", "00000"];
        $results = $natinfFiller->fromArray($data, true);

        //Only one is valid
        $this->assertEquals(1, count($results));
        $this->assertTrue(is_a($results[0], Natinf::class));
        $this->assertEquals(32208, $results[0]->getNumero());
    }
}
