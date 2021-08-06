<?php

/*
 * Vesta
 */

use App\Entity\RealEstate;
use App\Repository\RealEstateRepo;
use PHPUnit\Framework\TestCase;
use Tests\Toolbox\MongoDb\MongoCheck;
use Trismegiste\Toolbox\MongoDb\Repository;

/**
 * Description of RealEstateRepoTest
 *
 * @author flo
 */
class RealEstateRepoTest extends TestCase
{

    use MongoCheck;

    protected $sut;
    protected $mongo;

    protected function setUp(): void
    {
        $this->mongo = $this->createMock(Repository::class);
        $this->sut = new RealEstateRepo($this->mongo);
    }

    public function testWrite()
    {
        $this->mongo->expects($this->once())
                ->method('save');
        $obj = new RealEstate();
        $obj->setAddress("42 av. First Street");
        $obj->setPostalCode("06000");
        $obj->setCity("Nissa la Bella");
        $this->sut->save($obj);
    }

}
