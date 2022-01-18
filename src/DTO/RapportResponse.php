<?php

namespace App\DTO;

use App\Entity\PAM\PamRapport;
use Symfony\Component\Serializer\Annotation\Groups;

class RapportResponse extends PamRapport {

    const TYPE_BROUILLON = 'brouillon';
    const TYPE_VALIDE = 'validé';

    /**
     * @Groups({"view"})
     * @var
     */
    private $type;

    /**
     * @return mixed
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void {
        $this->type = $type;
    }
}
