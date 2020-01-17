<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RapportRepository")
 */
class Rapport {

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Service")
     * @ORM\JoinColumn(nullable=false)
     */
    private $serviceCreateur;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank
     *
     * @var DateTimeInterface
     */
    private $dateDebutMission;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank
     *
     * @var DateTimeInterface
     */
    private $dateFinMission;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Agent")
     * @Assert\NotBlank()
     * @Assert\Count(min = 1, minMessage = "Vous devez selectionner au moins un agent")
     */
    private $agents;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\Type(type="bool")
     */
    private $arme;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RapportMoyen", mappedBy="rapport", orphanRemoval=true,
     *                                                        cascade={"persist", "remove"})
     */
    private $moyens;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Mission", mappedBy="rapport", orphanRemoval=true,
     *                                                   cascade={"persist", "remove"})
     */
    private $missions;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\RapportRepartitionHeures", mappedBy="rapport", cascade={"persist",
     *                                                                   "remove"})
     */
    private $repartitionHeures;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $conjointe = false;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ServiceInterministeriel", cascade={"persist"})
     */
    private $serviceConjoints;

    public function getId(): ?int {
        return $this->id;
    }

    public function __construct() {
        $this->agents = new ArrayCollection();
        $this->moyens = new ArrayCollection();
        $this->missions = new ArrayCollection();
        $this->serviceConjoints = new ArrayCollection();
    }

    public function getDateDebutMission(): ?DateTimeInterface {
        return $this->dateDebutMission;
    }

    public function setDateDebutMission(DateTimeInterface $dateDebutMission): self {
        $this->dateDebutMission = $dateDebutMission;

        return $this;
    }

    public function getDateFinMission(): ?DateTimeInterface {
        return $this->dateFinMission;
    }

    public function setDateFinMission(DateTimeInterface $dateFinMission): self {
        $this->dateFinMission = $dateFinMission;

        return $this;
    }

    /**
     * @return Collection|Agent[]
     */
    public function getAgents(): Collection {
        return $this->agents;
    }

    public function addAgent(Agent $agent): self {
        if(!$this->agents->contains($agent)) {
            $this->agents[] = $agent;
        }

        return $this;
    }

    public function removeAgent(Agent $agent): self {
        if($this->agents->contains($agent)) {
            $this->agents->removeElement($agent);
        }

        return $this;
    }

    public function getCommentaire(): ?string {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getArme(): ?bool {
        return $this->arme;
    }

    public function setArme(bool $arme): self {
        $this->arme = $arme;

        return $this;
    }

    /**
     * @return Collection|RapportMoyen[]
     */
    public function getMoyens(): Collection {
        return $this->moyens;
    }

    public function addMoyen(RapportMoyen $moyen): self {
        if(!$this->moyens->contains($moyen)) {
            $this->moyens[] = $moyen;
            $moyen->setRapport($this);
        }

        return $this;
    }

    public function removeMoyen(RapportMoyen $moyen): self {
        if($this->moyens->contains($moyen)) {
            $this->moyens->removeElement($moyen);
            // set the owning side to null (unless already changed)
            if($moyen->getRapport() === $this) {
                $moyen->setRapport(null);
            }
        }

        return $this;
    }

    public function getServiceCreateur(): ?Service {
        return $this->serviceCreateur;
    }

    public function setServiceCreateur(?Service $serviceCreateur): self {
        $this->serviceCreateur = $serviceCreateur;

        return $this;
    }

    /**
     * @return Collection|Mission[]
     */
    public function getMissions(): Collection {
        return $this->missions;
    }

    public function addMission(Mission $mission): self {
        if(!$this->missions->contains($mission)) {
            $this->missions[] = $mission;
            $mission->setRapport($this);
        }

        return $this;
    }

    public function removeMission(Mission $mission): self {
        if($this->missions->contains($mission)) {
            $this->missions->removeElement($mission);
            // set the owning side to null (unless already changed)
            if($mission->getRapport() === $this) {
                $mission->setRapport(null);
            }
        }

        return $this;
    }

    public function getRepartitionHeures(): ?RapportRepartitionHeures {
        return $this->repartitionHeures;
    }

    public function setRepartitionHeures(RapportRepartitionHeures $repartitionHeures): self {
        $this->repartitionHeures = $repartitionHeures;

        // set the owning side of the relation if necessary
        if($repartitionHeures->getRapport() !== $this) {
            $repartitionHeures->setRapport($this);
        }

        return $this;
    }

    public function getConjointe(): ?bool
    {
        return $this->conjointe;
    }

    public function setConjointe(bool $conjointe): self
    {
        $this->conjointe = $conjointe;

        return $this;
    }

    /**
     * @return Collection|ServiceInterministeriel[]
     */
    public function getServiceConjoints(): Collection
    {
        return $this->serviceConjoints;
    }

    public function addServiceConjoint(ServiceInterministeriel $serviceConjoint): self
    {
        if (!$this->serviceConjoints->contains($serviceConjoint)) {
            $this->serviceConjoints[] = $serviceConjoint;
        }

        return $this;
    }

    public function removeServiceConjoint(ServiceInterministeriel $serviceConjoint): self
    {
        if ($this->serviceConjoints->contains($serviceConjoint)) {
            $this->serviceConjoints->removeElement($serviceConjoint);
        }

        return $this;
    }
}
