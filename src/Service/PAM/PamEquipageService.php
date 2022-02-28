<?php

namespace App\Service\PAM;

use App\Entity\Agent;
use App\Entity\FonctionAgent;
use App\Entity\FonctionParticuliereAgent;
use App\Entity\PAM\PamEquipage;
use App\Repository\AgentRepository;
use App\Repository\FonctionAgentRepository;
use App\Repository\FonctionParticuliereAgentRepository;
use App\Repository\PAM\PamEquipageRepository;

class PamEquipageService {

    /**
     * @var PamEquipageRepository
     */
    private $equipageRepository;

    /**
     * @var AgentRepository
     */
    private $agentRepository;

    /**
     * @var FonctionAgentRepository
     */
    private $fonctionAgentRepository;

    /**
     * @var FonctionParticuliereAgentRepository
     */
    private $fonctionParticuliereRepository;

    public function __construct(PamEquipageRepository $equipageRepository, AgentRepository $agentRepository,
                                FonctionAgentRepository $fonctionAgentRepository,
                                FonctionParticuliereAgentRepository $fonctionParticuliereAgentRepository)
    {
        $this->equipageRepository = $equipageRepository;
        $this->agentRepository = $agentRepository;
        $this->fonctionAgentRepository = $fonctionAgentRepository;
        $this->fonctionParticuliereRepository = $fonctionParticuliereAgentRepository;
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
     * @return Agent[]
     */
    public function autocomplete(?string $fullName = null) : array
    {
        return $this->agentRepository->autocomplete($fullName);
    }

    /**
     * @return FonctionAgent[]
     */
    public function listFonction() : array
    {
        return $this->fonctionAgentRepository->findAll();
    }

    /**
     * @return FonctionParticuliereAgent[]
     */
    public function listFonctionParticuliere() : array
    {
        return $this->fonctionParticuliereRepository->findAll();
    }

}
