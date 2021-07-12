<?php

/*
 * VirImmo
 */

namespace App\Entity;

/**
 * A physical address
 */
class Address
{

    public $body;
    public $cp;
    public $city;

    public function __construct(string $body = '', string $cp = '', string $city = '')
    {
        $this->body = $body;
        $this->city = $city;
        $this->cp = $cp;
    }

}
