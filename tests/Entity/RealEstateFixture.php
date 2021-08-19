<?php

/*
 * Vesta
 */

namespace App\Tests\Entity;

use App\Entity\AppartDescr;
use App\Entity\RealEstate;

trait RealEstateFixture
{

    protected function createRealEstate(string $city): RealEstate
    {
        $re = new RealEstate();
        $re->setCategory('Appartement');
        $info = new AppartDescr();
        $info->room = 5;
        $info->carrezArea = 55;
        $info->floor = 3;
        $re->setCity($city);
        $re->setAppartDescr($info);

        return $re;
    }

}
