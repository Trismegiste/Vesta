<?php

/*
 * Vesta
 */

namespace App\Tests\Entity;

use App\Entity\AppartDescr;
use App\Entity\Immovable;
use App\Entity\Negotiator;
use App\Entity\RealEstate;
use App\Entity\User;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\ObjectIdInterface;
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

    public function testCategory()
    {
        $this->sut->setCategory('appart');
        $this->assertEquals('appart', $this->sut->getCategory());
    }

    public function testSurface()
    {
        $desc = new AppartDescr();
        $desc->carrezArea = 123;
        $this->sut->setAppartDescr($desc);
        $this->assertEquals(123, $this->sut->getSurface());
    }

    public function testFloor()
    {
        $desc = new AppartDescr();
        $desc->floor = 5;
        $this->sut->setAppartDescr($desc);
        $this->assertEquals(5, $this->sut->getFloor());
    }

    public function testRoom()
    {
        $desc = new AppartDescr();
        $desc->room = 5;
        $this->sut->setAppartDescr($desc);
        $this->assertEquals(5, $this->sut->getRoom());
    }

    public function testEmptyTag()
    {
        $this->assertCount(0, $this->sut->getTag());
        $this->sut->deleteTag('yolo');
        $this->assertCount(0, $this->sut->getTag());
    }

    public function testAddingTag()
    {
        $this->sut->addTag('sdb');
        $this->assertCount(1, $this->sut->getTag());
        $this->sut->deleteTag('yolo');
        $this->assertCount(1, $this->sut->getTag());
        $this->sut->deleteTag('sdb');
        $this->assertCount(0, $this->sut->getTag());
    }

    public function testAddingDuplicatedTag()
    {
        $this->sut->addTag('sdb');
        $this->assertCount(1, $this->sut->getTag());
        $this->sut->addTag('sdb');
        $this->assertCount(1, $this->sut->getTag());
    }

    public function testPrix()
    {
        $this->sut->setPrice(42);
        $this->assertEquals(42, $this->sut->getPrice());
    }

    public function testAddress()
    {
        $this->sut->setAddress('123 starbase av.');
        $this->assertEquals('123 starbase av.', $this->sut->getAddress());
    }

    public function testCity()
    {
        $this->sut->setCity('Boca chica');
        $this->assertEquals('Boca chica', $this->sut->getCity());
    }

    public function testPostalCode()
    {
        $this->sut->setPostalCode('06000');
        $this->assertEquals('06000', $this->sut->getPostalCode());
    }

    public function testCurrency()
    {
        $this->assertEquals('EUR', $this->sut->getCurrency());
    }

    public function testGeoloc()
    {
        $this->assertFalse($this->sut->isGeoValid());
        $this->sut->setCoord(7, 43);
        $this->assertEquals(43, $this->sut->getLatitude());
        $this->assertEquals(7, $this->sut->getLongitude());
        $this->assertTrue($this->sut->isGeoValid());
    }

    public function testOwner()
    {
        $obj = new User('yolo');
        $obj->setPk(new ObjectId());
        $this->sut->setOwnerFk($obj);
        $this->assertInstanceOf(ObjectIdInterface::class, $this->sut->getOwnerFk());
    }

    public function testNegotiator()
    {
        $obj = new Negotiator('yolo');
        $obj->setPk(new ObjectId());
        $this->sut->setNegotiatorFk($obj);
        $this->assertInstanceOf(ObjectIdInterface::class, $this->sut->getNegotiatorFk());
    }

}
