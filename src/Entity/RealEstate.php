<?php

namespace App\Entity;

use Trismegiste\Toolbox\MongoDb\Root;
use Trismegiste\Toolbox\MongoDb\RootImpl;

/**
 * Dossier de vente qui va suivre le workflow
 */
class RealEstate implements Immovable, Root
{

    use RootImpl;

    protected $currentState;
    protected $location;

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
        return $this->location;
    }

}
