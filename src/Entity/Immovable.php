<?php

/*
 * VirImmo
 */

namespace App\Entity;

/**
 * Immovable object means it has an address
 * 
 * @author flo
 */
interface Immovable
{

    public function getAddress(): Address;
}
