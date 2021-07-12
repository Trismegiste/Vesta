<?php

namespace App\Entity;

/**
 * Dossier de vente qui va suivre le workflow
 */
class RealEstate implements Immovable
{

    protected $currentState;

    public function getCurrentState()
    {
        return $this->currentState;
    }

    public function setCurrentState($param, $context = [])
    {
        $this->currentState = $param;
    }

    public function getAddress(): Address
    {
        
    }

}
