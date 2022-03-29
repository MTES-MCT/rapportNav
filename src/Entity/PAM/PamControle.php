<?php

namespace App\Entity\PAM;

use App\Repository\PAM\PamControleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PamControleRepository::class)
 */
class PamControle
{
    /**
     * @Groups({"view"})
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="string", length=32)
     */
    private $pavillon;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nb_navire_controle;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nb_pv_peche_sanitaire;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nb_pv_equipement_securite;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nb_pv_titre_nav;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nb_pv_police;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nb_pv_env_pollution;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nb_autre_pv;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nb_nav_deroute;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nb_nav_interroge;

    /**
     *
     * @ORM\ManyToOne(targetEntity=PamRapport::class, inversedBy="controles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $rapport;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\ManyToOne(targetEntity=CategoryPamControle::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @Groups({"view", "draft", "save_rapport"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nb_controles_peche_sanitaire;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nb_nav_deroute_env_pollution;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nb_pv_titre_conduite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPavillon(): ?string
    {
        return $this->pavillon;
    }

    public function setPavillon(string $pavillon): self
    {
        $this->pavillon = $pavillon;

        return $this;
    }

    public function getNbNavireControle(): ?int
    {
        return $this->nb_navire_controle;
    }

    public function setNbNavireControle(?int $nb_navire_controle): self
    {
        $this->nb_navire_controle = $nb_navire_controle;

        return $this;
    }

    public function getNbPvPecheSanitaire(): ?int
    {
        return $this->nb_pv_peche_sanitaire;
    }

    public function setNbPvPecheSanitaire(?int $nb_pv_peche_sanitaire): self
    {
        $this->nb_pv_peche_sanitaire = $nb_pv_peche_sanitaire;

        return $this;
    }

    public function getNbPvEquipementSecurite(): ?int
    {
        return $this->nb_pv_equipement_securite;
    }

    public function setNbPvEquipementSecurite(?int $nb_pv_equipement_securite): self
    {
        $this->nb_pv_equipement_securite = $nb_pv_equipement_securite;

        return $this;
    }

    public function getNbPvTitreNav(): ?int
    {
        return $this->nb_pv_titre_nav;
    }

    public function setNbPvTitreNav(?int $nb_pv_titre_nav): self
    {
        $this->nb_pv_titre_nav = $nb_pv_titre_nav;

        return $this;
    }

    public function getNbPvPolice(): ?int
    {
        return $this->nb_pv_police;
    }

    public function setNbPvPolice(?int $nb_pv_police): self
    {
        $this->nb_pv_police = $nb_pv_police;

        return $this;
    }

    public function getNbPvEnvPollution(): ?int
    {
        return $this->nb_pv_env_pollution;
    }

    public function setNbPvEnvPollution(?int $nb_pv_env_pollution): self
    {
        $this->nb_pv_env_pollution = $nb_pv_env_pollution;

        return $this;
    }

    public function getNbAutrePv(): ?int
    {
        return $this->nb_autre_pv;
    }

    public function setNbAutrePv(?int $nb_autre_pv): self
    {
        $this->nb_autre_pv = $nb_autre_pv;

        return $this;
    }

    public function getNbNavDeroute(): ?int
    {
        return $this->nb_nav_deroute;
    }

    public function setNbNavDeroute(?int $nb_nav_deroute): self
    {
        $this->nb_nav_deroute = $nb_nav_deroute;

        return $this;
    }

    public function getNbNavInterroge(): ?int
    {
        return $this->nb_nav_interroge;
    }

    public function setNbNavInterroge(?int $nb_nav_interroge): self
    {
        $this->nb_nav_interroge = $nb_nav_interroge;

        return $this;
    }

    public function getRapport(): ?PamRapport
    {
        return $this->rapport;
    }

    public function setRapport(?PamRapport $rapport): self
    {
        $this->rapport = $rapport;

        return $this;
    }

    public function getCategory(): ?CategoryPamControle
    {
        return $this->category;
    }

    public function setCategory(?CategoryPamControle $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getNbControlesPecheSanitaire(): ?int
    {
        return $this->nb_controles_peche_sanitaire;
    }

    public function setNbControlesPecheSanitaire(?int $nb_controles_peche_sanitaire): self
    {
        $this->nb_controles_peche_sanitaire = $nb_controles_peche_sanitaire;

        return $this;
    }

    public function getNbNavDerouteEnvPollution(): ?int
    {
        return $this->nb_nav_deroute_env_pollution;
    }

    public function setNbNavDerouteEnvPollution(?int $nb_nav_deroute_env_pollution): self
    {
        $this->nb_nav_deroute_env_pollution = $nb_nav_deroute_env_pollution;

        return $this;
    }

    public function getNbPvTitreConduite(): ?int
    {
        return $this->nb_pv_titre_conduite;
    }

    public function setNbPvTitreConduite(?int $nb_pv_titre_conduite): self
    {
        $this->nb_pv_titre_conduite = $nb_pv_titre_conduite;

        return $this;
    }
}
