<?php

/*
 * Vesta
 */

namespace App\Entity;

/**
 * Visit of a consumer (buyer) in a real estate
 */
class Visit extends Meeting
{

    protected $owner;
    protected $buyer;
    protected $trader;

}
