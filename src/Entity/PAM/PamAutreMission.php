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

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dureeOperationsSurveillanceTrafic;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbNaviresOperationsSurveillanceTrafic;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbOperationsSurveillanceTrafic;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbPermanenceVigimer;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dureePermanenceVigimer;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbNaviresPermanenceVigimer;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbPermanenceBAAEM;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $dureePermanenceBAAEM;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbNaviresPermanenceBAAEM;

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

    public function getDureeOperationsSurveillanceTrafic(): ?int
    {
        return $this->dureeOperationsSurveillanceTrafic;
    }

    public function setDureeOperationsSurveillanceTrafic(?int $dureeOperationsSurveillanceTrafic): self
    {
        $this->dureeOperationsSurveillanceTrafic = $dureeOperationsSurveillanceTrafic;

        return $this;
    }

    public function getNbNaviresOperationsSurveillanceTrafic(): ?int
    {
        return $this->nbNaviresOperationsSurveillanceTrafic;
    }

    public function setNbNaviresOperationsSurveillanceTrafic(?int $nbNaviresOperationsSurveillanceTrafic): self
    {
        $this->nbNaviresOperationsSurveillanceTrafic = $nbNaviresOperationsSurveillanceTrafic;

        return $this;
    }

    public function getNbOperationsSurveillanceTrafic(): ?int
    {
        return $this->nbOperationsSurveillanceTrafic;
    }

    public function setNbOperationsSurveillanceTrafic(?int $nbOperationsSurveillanceTrafic): self
    {
        $this->nbOperationsSurveillanceTrafic = $nbOperationsSurveillanceTrafic;

        return $this;
    }

    public function getNbPermanenceVigimer(): ?int
    {
        return $this->nbPermanenceVigimer;
    }

    public function setNbPermanenceVigimer(?int $nbPermanenceVigimer): self
    {
        $this->nbPermanenceVigimer = $nbPermanenceVigimer;

        return $this;
    }

    public function getDureePermanenceVigimer(): ?int
    {
        return $this->dureePermanenceVigimer;
    }

    public function setDureePermanenceVigimer(?int $dureePermanenceVigimer): self
    {
        $this->dureePermanenceVigimer = $dureePermanenceVigimer;

        return $this;
    }

    public function getNbNaviresPermanenceVigimer(): ?int
    {
        return $this->nbNaviresPermanenceVigimer;
    }

    public function setNbNaviresPermanenceVigimer(?int $nbNaviresPermanenceVigimer): self
    {
        $this->nbNaviresPermanenceVigimer = $nbNaviresPermanenceVigimer;

        return $this;
    }

    public function getNbPermanenceBAAEM(): ?int
    {
        return $this->nbPermanenceBAAEM;
    }

    public function setNbPermanenceBAAEM(?int $nbPermanenceBAAEM): self
    {
        $this->nbPermanenceBAAEM = $nbPermanenceBAAEM;

        return $this;
    }

    public function getDureePermanenceBAAEM(): ?int
    {
        return $this->dureePermanenceBAAEM;
    }

    public function setDureePermanenceBAAEM(?int $dureePermanenceBAAEM): self
    {
        $this->dureePermanenceBAAEM = $dureePermanenceBAAEM;

        return $this;
    }

    public function getNbNaviresPermanenceBAAEM(): ?int
    {
        return $this->nbNaviresPermanenceBAAEM;
    }

    public function setNbNaviresPermanenceBAAEM(?int $nbNaviresPermanenceBAAEM): self
    {
        $this->nbNaviresPermanenceBAAEM = $nbNaviresPermanenceBAAEM;

        return $this;
    }
}
