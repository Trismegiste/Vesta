<?php

use App\Entity\ImmoSet;
use App\Entity\RealEstate;
use PHPUnit\Framework\TestCase;

/*
 * Vesta
 */

class ImmoSetTest extends TestCase
{

    protected $sut;

    protected function setUp(): void
    {
        $immo1 = new RealEstate();
        $immo1->setLatitude(43);
        $immo1->setLongitude(7);

        $immo2 = new RealEstate();
        $immo2->setLatitude(44);
        $immo2->setLongitude(8);

        $this->sut = new ImmoSet(new ArrayIterator([$immo1, $immo2]));
    }

    public function testBadType()
    {
        $this->expectException(InvalidArgumentException::class);
        $bad = new ImmoSet(new ArrayIterator([new stdClass()]));
        $bad->current();
    }

    public function testDefaultBoudariesEmpty()
    {
        $vide = new ImmoSet(new ArrayIterator([]));
        $this->assertEquals([[90, 180], [-90, -180]], $this->sut->getBoundaries());
    }

    public function testBoundariesAfterScan()
    {
        $this->assertEquals([[90, 180], [-90, -180]], $this->sut->getBoundaries());
        foreach ($this->sut as $key => $dummy) {
            // nothing
        }

        $this->assertEquals([[43, 7], [44, 8]], $this->sut->getBoundaries());
    }

}
