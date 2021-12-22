<?php

namespace App\Entity\PAM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Table(name="pam_rapport")
 * @ORM\Entity(repositoryClass="App\Repository\PAM\PamRapportRepository")
 * @ORM\HasLifecycleCallbacks
 */
class PamRapport
{
    /**
     * @Groups({"view"})
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"view"})
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $updated_at;

    /**
     * @Groups({"view", "draft"})
     * @ORM\Column(type="integer")
     */
    private $nb_jours_mer;

    /**
     * @Groups({"view", "draft"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nav_eff;

    /**
     * @Groups({"view", "draft"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $mouillage;

    /**
     * @Groups({"view", "draft"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maintenance;

    /**
     * @Groups({"view", "draft"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $meteo;

    /**
     * @Groups({"view", "draft"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $representation;

    /**
     * @Groups({"view", "draft"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $administratif;

    /**
     * @Groups({"view", "draft"})
     * @ORM\Column(type="float", nullable=true)
     */
    private $autre;

    /**
     * @Groups({"view", "draft"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $contr_port;

    /**
     * @Groups({"view", "draft"})
     * @ORM\Column(type="integer")
     */
    private $technique;

    /**
     * @Groups({"view", "draft"})
     * @ORM\Column(type="float", nullable=true)
     */
    private $distance;

    /**
     * @Groups({"view", "draft"})
     * @ORM\Column(type="float", nullable=true)
     */
    private $go_marine;

    /**
     * @Groups({"view", "draft"})
     * @ORM\Column(type="float", nullable=true)
     */
    private $essence;

    /**
     * @Groups({"view", "draft"})
     * @ORM\OneToOne(targetEntity=PamEquipage::class, inversedBy="rapport", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $equipage;

    /**
     * @Groups({"view", "draft"})
     * @ORM\OneToMany(targetEntity=PamControle::class, mappedBy="rapport", orphanRemoval=true, cascade={"persist", "remove"})
     */
    private $controles;

    /**
     * @Groups({"view", "draft"})
     * @ORM\OneToMany(targetEntity=PamMission::class, mappedBy="rapport", orphanRemoval=true, cascade={"persist"})
     */
    private $missions;

    /**
     * @Groups({"view", "draft"})
     * @ORM\Column(type="string", nullable=true)
     */
    private $start_date;

    /**
     * @Groups({"view", "draft"})
     * @ORM\Column(type="string", nullable=true)
     */
    private $end_date;

    /**
     * @Groups({"view", "draft"})
     * @ORM\Column(type="string", nullable=true)
     */
    private $start_time;

    /**
     * @Groups({"view", "draft"})
     * @ORM\Column(type="string", nullable=true)
     */
    private $end_time;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $number;


    public function __construct()
    {
        $this->controles = new ArrayCollection();
        $this->missions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getNbJoursMer(): ?int
    {
        return $this->nb_jours_mer;
    }

    public function setNbJoursMer(?int $nb_jours_mer): self
    {
        $this->nb_jours_mer = $nb_jours_mer;

        return $this;
    }

    public function getNavEff(): ?int
    {
        return $this->nav_eff;
    }

    public function setNavEff(?int $nav_eff): self
    {
        $this->nav_eff = $nav_eff;

        return $this;
    }

    public function getMouillage(): ?int
    {
        return $this->mouillage;
    }

    public function setMouillage(?int $mouillage): self
    {
        $this->mouillage = $mouillage;

        return $this;
    }

    public function getMaintenance(): ?int
    {
        return $this->maintenance;
    }

    public function setMaintenance(?int $maintenance): self
    {
        $this->maintenance = $maintenance;

        return $this;
    }

    public function getMeteo(): ?int
    {
        return $this->meteo;
    }

    public function setMeteo(?int $meteo): self
    {
        $this->meteo = $meteo;

        return $this;
    }

    public function getRepresentation(): ?int
    {
        return $this->representation;
    }

    public function setRepresentation(?int $representation): self
    {
        $this->representation = $representation;

        return $this;
    }

    public function getAdministratif(): ?int
    {
        return $this->administratif;
    }

    public function setAdministratif(?int $administratif): self
    {
        $this->administratif = $administratif;

        return $this;
    }

    public function getAutre(): ?float
    {
        return $this->autre;
    }

    public function setAutre(?float $autre): self
    {
        $this->autre = $autre;

        return $this;
    }

    public function getContrPort(): ?int
    {
        return $this->contr_port;
    }

    public function setContrPort(?int $contr_port): self
    {
        $this->contr_port = $contr_port;

        return $this;
    }

    public function getTechnique(): ?int
    {
        return $this->technique;
    }

    public function setTechnique(?int $technique): self
    {
        $this->technique = $technique;

        return $this;
    }

    public function getDistance(): ?float
    {
        return $this->distance;
    }

    public function setDistance(?float $distance): self
    {
        $this->distance = $distance;

        return $this;
    }

    public function getGoMarine(): ?float
    {
        return $this->go_marine;
    }

    public function setGoMarine(?float $go_marine): self
    {
        $this->go_marine = $go_marine;

        return $this;
    }

    public function getEssence(): ?float
    {
        return $this->essence;
    }

    public function setEssence(?float $essence): self
    {
        $this->essence = $essence;

        return $this;
    }

    /**
     * @ORM\PrePersist()
     * @return void
     */
    public function setCreatedAtValue() {
        $this->created_at = new \DateTimeImmutable("now");
    }

    public function getEquipage(): ?PamEquipage
    {
        return $this->equipage;
    }

    public function setEquipage(PamEquipage $equipage): self
    {
        $this->equipage = $equipage;

        return $this;
    }

    /**
     * @return Collection|PamControle[]
     */
    public function getControles(): Collection
    {
        return $this->controles;
    }

    public function addControle(PamControle $controle): self
    {
        if (!$this->controles->contains($controle)) {
            $this->controles[] = $controle;
            $controle->setRapport($this);
        }

        return $this;
    }

    public function removeControle(PamControle $controle): self
    {
        if ($this->controles->removeElement($controle)) {
            // set the owning side to null (unless already changed)
            if ($controle->getRapport() === $this) {
                $controle->setRapport(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PamMission[]
     */
    public function getMissions(): Collection
    {
        return $this->missions;
    }

    public function addMission(PamMission $mission): self
    {
        if (!$this->missions->contains($mission)) {
            $this->missions[] = $mission;
            $mission->setRapport($this);
        }

        return $this;
    }

    public function removeMission(PamMission $mission): self
    {
        if ($this->missions->removeElement($mission)) {
            // set the owning side to null (unless already changed)
            if ($mission->getRapport() === $this) {
                $mission->setRapport(null);
            }
        }

        return $this;
    }

    public function getStartDate()
    {
        return $this->start_date;
    }

    public function setStartDate($start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate()
    {
        return $this->end_date;
    }

    public function setEndDate(?string $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
    }

    public function getStartTime()
    {
        return $this->start_time;
    }

    public function setStartTime( $start_time): self
    {
        $this->start_time = $start_time;

        return $this;
    }

    public function getEndTime()
    {
        return $this->end_time;
    }

    public function setEndTime( $end_time): self
    {
        $this->end_time = $end_time;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

}
