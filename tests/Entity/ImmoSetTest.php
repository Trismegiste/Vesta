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
        $this->sut = new ImmoSet(new ArrayIterator([new RealEstate()]));
    }

    public function testBadType()
    {
        $this->expectException(InvalidArgumentException::class);
        $bad = new ImmoSet(new ArrayIterator([new stdClass()]));
        $bad->getBoundaries();
    }

}
