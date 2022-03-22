<?php

namespace App\Entity\PAM;

use App\Repository\PAM\PamAutreMissionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PamAutreMissionRepository::class)
 */
class PamAutreMission
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbAssistanceSauvetage;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dureeAssistanceSauvetage;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbManifestationsNautiques;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dureeManifestationsNautiques;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbLuttePollution;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dureeLuttePollution;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbAssistanceSauvetage(): ?int
    {
        return $this->nbAssistanceSauvetage;
    }

    public function setNbAssistanceSauvetage(?int $nbAssistanceSauvetage): self
    {
        $this->nbAssistanceSauvetage = $nbAssistanceSauvetage;

        return $this;
    }

    public function getDureeAssistanceSauvetage(): ?int
    {
        return $this->dureeAssistanceSauvetage;
    }

    public function setDureeAssistanceSauvetage(?int $dureeAssistanceSauvetage): self
    {
        $this->dureeAssistanceSauvetage = $dureeAssistanceSauvetage;

        return $this;
    }

    public function getNbManifestationsNautiques(): ?int
    {
        return $this->nbManifestationsNautiques;
    }

    public function setNbManifestationsNautiques(?int $nbManifestationsNautiques): self
    {
        $this->nbManifestationsNautiques = $nbManifestationsNautiques;

        return $this;
    }

    public function getDureeManifestationsNautiques(): ?int
    {
        return $this->dureeManifestationsNautiques;
    }

    public function setDureeManifestationsNautiques(?int $dureeManifestationsNautiques): self
    {
        $this->dureeManifestationsNautiques = $dureeManifestationsNautiques;

        return $this;
    }

    public function getNbLuttePollution(): ?int
    {
        return $this->nbLuttePollution;
    }

    public function setNbLuttePollution(?int $nbLuttePollution): self
    {
        $this->nbLuttePollution = $nbLuttePollution;

        return $this;
    }

    public function getDureeLuttePollution(): ?int
    {
        return $this->dureeLuttePollution;
    }

    public function setDureeLuttePollution(?int $dureeLuttePollution): self
    {
        $this->dureeLuttePollution = $dureeLuttePollution;

        return $this;
    }
}
