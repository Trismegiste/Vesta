<?php

namespace App\Entity;

use Trismegiste\Toolbox\MongoDb\Root;
use Trismegiste\Toolbox\MongoDb\RootImpl;

/**
 * RealEstate is a real Estate
 */
class RealEstate implements Immovable, Root
{

    use RootImpl;

    protected $currentState;
    protected $location;

    public function __construct()
    {
        $this->location = new Address();
    }

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
