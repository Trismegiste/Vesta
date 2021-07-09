<?php

namespace App\Entity;

/**
 * Dossier de vente qui va suivre le workflow
 */
class RealEstate
{

    protected $currentState;

    public function getCurrentState(): string
    {
        return $this->currentState;
    }

    public function setCurrentState(string $param)
    {
        $this->currentState = $param;
    }

}
