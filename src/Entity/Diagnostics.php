<?php

/*
 * Vesta
 */

namespace App\Entity;

use MongoDB\BSON\Persistable;
use Trismegiste\Toolbox\MongoDb\PersistableImpl;

/**
 * Description of Diagnostics
 */
class Diagnostics implements Persistable
{

    use PersistableImpl;

    // standards
    public $houseStandardsFlag = [];
    // diagnostics
    public $diagnosticsFlag = [];
    // energy loss
    public $energyPerformance;
    public $energyUptake = 0; // unit: KWh/m² per year
    public $energyUptakeReportDate;
    public $greenhouseGas = 0; // unit: Kg co²/m² per year 
    public $greenhouseGasReportDate;

}
