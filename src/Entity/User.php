<?php


namespace App\Entity;

use App\Entity\PAM\PamDraft;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="`user`")
 */
class User extends BaseUser {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @Groups({"draft"})
     * @ORM\ManyToOne(targetEntity="App\Entity\Service")
     */
    protected $service;

    /**
     * @ORM\Column(type="boolean", options={"default" : 0})
     */
    private $chefUlam=false;

    public function __construct()
    {
        parent::__construct();
    }

    public function getId() {
        return $this->id;
    }

    public function getService(): ?Service {
        return $this->service;
    }

    public function setService(?Service $service): self {
        $this->service = $service;

        return $this;
    }

    public function getChefUlam(): ?bool
    {
        return $this->chefUlam;
    }

    public function setChefUlam(bool $chefUlam): self
    {
        $this->chefUlam = $chefUlam;

        return $this;
    }
}
