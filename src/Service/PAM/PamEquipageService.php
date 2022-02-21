<?php

namespace App\Service\PAM;

use App\Entity\PAM\PamEquipage;
use App\Repository\AgentRepository;
use App\Repository\PAM\PamEquipageRepository;
use Doctrine\ORM\EntityManagerInterface;

class PamEquipageService {

    /**
     * @var PamEquipageRepository
     */
    private $equipageRepository;

    /**
     * @var AgentRepository
     */
    private $agentRepository;

    public function __construct(PamEquipageRepository $equipageRepository, AgentRepository $agentRepository)
    {
        $this->equipageRepository = $equipageRepository;
        $this->agentRepository = $agentRepository;
    }

    /**
     * Retrieve the last equipage used
     * @return PamEquipage|null
     */
    public function getLastEquipage() : ?PamEquipage
    {
        return $this->equipageRepository->findLastEquipage();
    }

    /**
     * Autocompletion de la liste des agents
     *
     * @param string|null $fullName
     *
     * @return array
     */
    public function autocomplete(?string $fullName) : array
    {
        return $this->agentRepository->autocomplete($fullName);
    }

}
