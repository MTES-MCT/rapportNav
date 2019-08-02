<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\Service")
     */
    protected $service;

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
}
