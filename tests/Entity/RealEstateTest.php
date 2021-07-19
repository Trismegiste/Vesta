<?php

/*
 * Vesta
 */

namespace App\Tests\Entity;

use App\Entity\Immovable;
use App\Entity\RealEstate;
use PHPUnit\Framework\TestCase;

/**
 * RealEstateTest tests for RealEstate
 */
class RealEstateTest extends TestCase
{

    protected $sut;

    protected function setUp(): void
    {
        $this->sut = new RealEstate();
    }

    public function testCreation()
    {
        $this->assertInstanceOf(Immovable::class, $this->sut);
    }

}
