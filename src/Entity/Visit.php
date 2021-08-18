<?php

/*
 * Vesta
 */

namespace App\Entity;

/**
 * Visit of a consumer (buyer) for a real estate with the negotiator and/or the owner
 */
class Visit extends Meeting
{

    // fk
    protected $owner;
    protected $buyer;
    protected $negotiator;

}
