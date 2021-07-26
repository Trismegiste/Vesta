<?php

/*
 * Vesta
 */

namespace App\Entity;

/**
 * Photoshoot is the first visit of a trader to shoot the real estate
 */
class Photoshoot extends Meeting
{

    protected $trader;
    protected $realEstate;

}
