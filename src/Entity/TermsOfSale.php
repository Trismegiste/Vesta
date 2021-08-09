<?php

/*
 * Vesta
 */

namespace App\Entity;

use MongoDB\BSON\Persistable;
use Trismegiste\Toolbox\MongoDb\PersistableImpl;

/**
 * Conditions de vente
 */
class TermsOfSale implements Persistable
{

    use PersistableImpl;

    // mandatary
    public $mandataryName;
    public $mandataryFk;
    public $mandateNumber;
    public $mandateStart;
    public $mandateEnd;
    // info
    public $availabilityDate; // when the real estate is free
    public $availableRent = false;
    public $lifeAnnuity = false;
    public $newProgram = false;
    public $investmentProduct = false;
    public $propertyTax;
    public $housingTax;
    public $charge;
    public $heatingCost;
    public $alotNumber;

}
