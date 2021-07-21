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

    public function testTitre()
    {
        $this->sut->setTitre("Un titre");
        $this->assertEquals('Un titre', $this->sut->getTitre());
    }

    public function testDescription()
    {
        $this->sut->setDescription("Description");
        $this->assertEquals('Description', $this->sut->getDescription());
    }

    public function testSurface()
    {
        $this->sut->setSurface(32.5);
        $this->assertEquals(32, $this->sut->getSurface());
    }

    public function testNombrePiece()
    {
        $this->sut->setPiece(3.5);
        $this->assertEquals(3, $this->sut->getPiece());
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
        $this->sut->setPrix(42);
        $this->assertEquals(42, $this->sut->getPrix());
    }

}
