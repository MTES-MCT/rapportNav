<?php

namespace App\Request\PAM;

class PavillonRequest {

    private $id;

    private $pavillon;

    private $nb_navire_controle;

    private $nb_pv_peche_sanitaire;

    private $nb_equipement_securite;

    private $nb_pv_titre_nav;

    private $nb_pv_police;

    private $nb_pv_env_pollution;

    private $nb_autre_pv;

    private $nb_nav_deroute;

    private $nb_nav_interroge;

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPavillon() {
        return $this->pavillon;
    }

    /**
     * @param mixed $pavillon
     */
    public function setPavillon($pavillon): void {
        $this->pavillon = $pavillon;
    }

    /**
     * @return mixed
     */
    public function getNbNavireControle() {
        return $this->nb_navire_controle;
    }

    /**
     * @param mixed $nb_navire_controle
     */
    public function setNbNavireControle($nb_navire_controle): void {
        $this->nb_navire_controle = $nb_navire_controle;
    }

    /**
     * @return mixed
     */
    public function getNbPvPecheSanitaire() {
        return $this->nb_pv_peche_sanitaire;
    }

    /**
     * @param mixed $nb_pv_peche_sanitaire
     */
    public function setNbPvPecheSanitaire($nb_pv_peche_sanitaire): void {
        $this->nb_pv_peche_sanitaire = $nb_pv_peche_sanitaire;
    }

    /**
     * @return mixed
     */
    public function getNbEquipementSecurite() {
        return $this->nb_equipement_securite;
    }

    /**
     * @param mixed $nb_equipement_securite
     */
    public function setNbEquipementSecurite($nb_equipement_securite): void {
        $this->nb_equipement_securite = $nb_equipement_securite;
    }

    /**
     * @return mixed
     */
    public function getNbPvTitreNav() {
        return $this->nb_pv_titre_nav;
    }

    /**
     * @param mixed $nb_pv_titre_nav
     */
    public function setNbPvTitreNav($nb_pv_titre_nav): void {
        $this->nb_pv_titre_nav = $nb_pv_titre_nav;
    }

    /**
     * @return mixed
     */
    public function getNbPvPolice() {
        return $this->nb_pv_police;
    }

    /**
     * @param mixed $nb_pv_police
     */
    public function setNbPvPolice($nb_pv_police): void {
        $this->nb_pv_police = $nb_pv_police;
    }

    /**
     * @return mixed
     */
    public function getNbPvEnvPollution() {
        return $this->nb_pv_env_pollution;
    }

    /**
     * @param mixed $nb_pv_env_pollution
     */
    public function setNbPvEnvPollution($nb_pv_env_pollution): void {
        $this->nb_pv_env_pollution = $nb_pv_env_pollution;
    }

    /**
     * @return mixed
     */
    public function getNbAutrePv() {
        return $this->nb_autre_pv;
    }

    /**
     * @param mixed $nb_autre_pv
     */
    public function setNbAutrePv($nb_autre_pv): void {
        $this->nb_autre_pv = $nb_autre_pv;
    }

    /**
     * @return mixed
     */
    public function getNbNavDeroute() {
        return $this->nb_nav_deroute;
    }

    /**
     * @param mixed $nb_nav_deroute
     */
    public function setNbNavDeroute($nb_nav_deroute): void {
        $this->nb_nav_deroute = $nb_nav_deroute;
    }

    /**
     * @return mixed
     */
    public function getNbNavInterroge() {
        return $this->nb_nav_interroge;
    }

    /**
     * @param mixed $nb_nav_interroge
     */
    public function setNbNavInterroge($nb_nav_interroge): void {
        $this->nb_nav_interroge = $nb_nav_interroge;
    }





}