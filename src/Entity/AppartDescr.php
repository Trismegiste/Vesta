<?php

/*
 * Vesta
 */

namespace App\Entity;

use MongoDB\BSON\Persistable;
use Trismegiste\Toolbox\MongoDb\PersistableImpl;

/**
 * Description of AppartDescr
 */
class AppartDescr implements Persistable
{

    use PersistableImpl;

    public $room;
    public $bedroom;
    public $floor;
    public $bathroom;
    public $toilet;
    public $shower;
    public $totalArea = 0;
    public $carrezArea = 0;
    public $livingRoomArea = 0;
    public $ceilingHeight;
    public $lighting;
    public $scenery;
    public $neighborhood;
    public $condition;
    public $transportation;
    public $schoolNearby;
    public $storeNearby;

}
