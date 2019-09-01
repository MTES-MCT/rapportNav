<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MissionRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({
 *     "navire" = "MissionNavire",
 *     "commerce" = "MissionCommerce",
 *     "pecheapied" = "MissionPechePied",
 *     "administratif" = "MissionAdministratif",
 *     "formation" = "MissionFormation"
 *     })
 */
abstract class Mission implements \JsonSerializable {
    public const RAPPORTTYPES = [
        "navire" => "MissionNavire",
        "commerce" => "MissionCommerce",
        "pecheapied" => "MissionPechePied",
        "administratif" => "MissionAdministratif",
        "formation" => "MissionFormation"];

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Rapport", inversedBy="missions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rapport;

    /**
     * @ORM\Column(type="boolean")
     */
    private $terrestre;
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ZoneGeographique")
     */
    private $zones;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=8, nullable=true)
     */
    private $gpsLat;


    /**
     * @ORM\Column(type="decimal", precision=11, scale=8, nullable=true)
     */
    private $gpsLng;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    public abstract function getControles();

    public function jsonSerialize() {
        $data = [];

        $data['terrestre'] = $this->getTerrestre();
        $data['zones'] = [];
        foreach($this->getZones() as $zone) {
            $data['zones'][] = $zone->getId();
        }
        $data['gpslat'] = $this->getGpsLat();
        $data['gpslng'] = $this->getGpsLng();
        $data['commentaire'] = $this->getCommentaire();

        return $data;
    }

    public function __construct() {
        $this->zones = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getRapport(): ?Rapport {
        return $this->rapport;
    }

    public function setRapport(?Rapport $rapport): self {
        $this->rapport = $rapport;

        return $this;
    }

    public function getTerrestre(): ?bool {
        return $this->terrestre;
    }

    public function setTerrestre(bool $terrestre): self {
        $this->terrestre = $terrestre;

        return $this;
    }

    /**
     * @return Collection|ZoneGeographique[]
     */
    public function getZones(): Collection {
        return $this->zones;
    }

    public function addZone(ZoneGeographique $zone): self {
        if(!$this->zones->contains($zone)) {
            $this->zones[] = $zone;
        }

        return $this;
    }

    public function removeZone(ZoneGeographique $zone): self {
        if($this->zones->contains($zone)) {
            $this->zones->removeElement($zone);
        }

        return $this;
    }

    public function getGpsLat(): ?string {
        return $this->gpsLat;
    }

    public function setGpsLat(?string $gpsLat): self {
        $this->gpsLat = $gpsLat;

        return $this;
    }

    public function getGpsLng(): ?string {
        return $this->gpsLng;
    }

    public function setGpsLng(?string $gpsLng): self {
        $this->gpsLng = $gpsLng;

        return $this;
    }

    public function getCommentaire(): ?string {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self {
        $this->commentaire = $commentaire;

        return $this;
    }
}
