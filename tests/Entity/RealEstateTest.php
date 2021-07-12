<?php

/*
 * VirImmo
 */

namespace App\Tests\Entity;

use App\Entity\RealEstate;
use PHPUnit\Framework\TestCase;

/**
 * Description of RealEstate
 *
 * @author flo
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
        $this->assertInstanceOf(\App\Entity\Immovable::class, $this->sut);
    }

}
