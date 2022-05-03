<?php

namespace App\Exception;

class BordeeNotFound extends \Exception {

    public function __construct(string $bordee, $code = 404, \Throwable $previous = null) {
        $message = "Cette bordée : " . $bordee . " n'existe pas.";
        parent::__construct($message, $code, $previous);
    }

}
