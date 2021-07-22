<?php

/*
 * Vesta
 */

namespace App\Entity;

/**
 * Immovable object means it has an address
 */
interface Immovable
{

    public function getAddress(): Address;

    public function setCoord(float $long, float $lat): void;

    public function getLatitude(): float;

    public function getLongitude(): float;
}
