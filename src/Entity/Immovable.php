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

    public function setAddress(string $addr): void;

    public function setCity(string $c): void;

    public function setPostalCode(string $pc);

    public function getAddress(): string;

    public function getPostalCode(): string;

    public function getCity(): string;

    public function getLatitude(): float;

    public function getLongitude(): float;

    public function setLatitude(float $l): void;

    public function setLongitude(float $l): void;
}
