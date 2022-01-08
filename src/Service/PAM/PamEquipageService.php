<?php

namespace App\Service\PAM;

use App\Entity\PAM\PamEquipage;
use Doctrine\ORM\EntityManagerInterface;

class PamEquipageService {

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Retrieve the last equipage used
     * @return PamEquipage|null
     */
    public function getLastEquipage() : ?PamEquipage
    {
        return $this->em->getRepository(PamEquipage::class)->findLastEquipage();
    }

}
