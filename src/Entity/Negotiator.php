<?php

/*
 * Vesta
 */

namespace App\Entity;

/**
 * Negotiator negotiates for Real Estate
 */
class Negotiator extends User
{

    protected $city = '';

    public function __construct(string $user)
    {
        parent::__construct($user);
        $this->roles = ['ROLE_NEGOTIATOR'];
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $c): void
    {
        $this->city = $c;
    }

}
