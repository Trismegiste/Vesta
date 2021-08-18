<?php

/*
 * Vesta
 */

namespace App\Entity;

use Trismegiste\Toolbox\MongoDb\Root;
use Trismegiste\Toolbox\MongoDb\RootImpl;

/**
 * Generic class of a meeting between users at a location and a date
 */
abstract class Meeting implements Root
{

    use RootImpl;

    protected $location;
    protected $rdvTime;

    public function __construct(Immovable $loc, \DateTime $ts)
    {
        $this->location = $loc; // @todo local copy
        $this->rdvTime = $ts;
    }

}
