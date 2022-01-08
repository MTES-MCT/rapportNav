<?php

namespace App\Entity\PAM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\GreaterThanOrEqual(value="0")
     * @Groups({"view", "draft"})
     * @ORM\Column(type="integer")
     */
    private $nb_jours_mer;

    /**
     * @Assert\GreaterThanOrEqual(value="0")
     * @Groups({"view", "draft"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nav_eff;

    /**
     * @Assert\GreaterThanOrEqual(value="0")
     * @Groups({"view", "draft"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $mouillage;

    /**
     * @Assert\GreaterThanOrEqual(value="0")
     * @Groups({"view", "draft"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maintenance;

    /**
     * @Assert\GreaterThanOrEqual(value="0")
     * @Groups({"view", "draft"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $meteo;

    /**
     * @Assert\GreaterThanOrEqual(value="0")
     * @Groups({"view", "draft"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $representation;

    /**
     * @Assert\GreaterThanOrEqual(value="0")
     * @Groups({"view", "draft"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $administratif;

    /**
     * @Assert\GreaterThanOrEqual(value="0")
     * @Groups({"view", "draft"})
     * @ORM\Column(type="float", nullable=true)
     */
    private $autre;

    /**
     * @Assert\GreaterThanOrEqual(value="0")
     * @Groups({"view", "draft"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $contr_port;

    /**
     * @Assert\GreaterThanOrEqual(value="0")
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
     * @Assert\GreaterThanOrEqual(value="0")
     * @Groups({"view", "draft"})
     * @ORM\Column(type="float", nullable=true)
     */
    private $go_marine;

    /**
     * @Assert\GreaterThanOrEqual(value="0")
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
     * @ORM\Column(type="string", length=20)
     */
    private $number;

    /**
     * @Groups({"view", "draft"})
     * @Assert\NotBlank()
     * @ORM\Column(type="datetime")
     */
    private $start_datetime;

    /**
     * @Groups({"view", "draft"})
     * @Assert\NotBlank()
     * @ORM\Column(type="datetime")
     */
    private $end_datetime;


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



    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getStartDatetime(): ?\DateTimeInterface
    {
        return $this->start_datetime;
    }

    public function setStartDatetime(\DateTimeInterface $start_datetime): self
    {
        $this->start_datetime = $start_datetime;

        return $this;
    }

    public function getEndDatetime(): ?\DateTimeInterface
    {
        return $this->end_datetime;
    }

    public function setEndDatetime(\DateTimeInterface $end_datetime): self
    {
        $this->end_datetime = $end_datetime;

        return $this;
    }

}
