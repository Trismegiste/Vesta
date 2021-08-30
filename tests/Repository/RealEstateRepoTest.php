<?php

/*
 * Vesta
 */

use App\Entity\RealEstate;
use App\Repository\RealEstateRepo;
use MongoDB\BSON\ObjectIdInterface;
use PHPUnit\Framework\TestCase;
use Tests\Toolbox\MongoDb\MongoCheck;
use Trismegiste\Toolbox\MongoDb\Repository;

class RealEstateRepoTest extends TestCase
{

    use MongoCheck;

    protected $sut;
    protected $repo;

    protected function setUp(): void
    {
        $this->repo = $this->createMock(Repository::class);
        $this->sut = new RealEstateRepo($this->repo);
    }

    public function testWrite()
    {
        $this->repo->expects($this->once())
                ->method('save');
        $obj = new RealEstate();
        $this->sut->save($obj);
    }

    public function testSearch()
    {
        $this->repo->expects($this->once())
                ->method('search');
        $this->sut->search();
    }

    public function testSearchByOwner()
    {
        $this->repo->expects($this->once())
                ->method('search')
                ->with($this->arrayHasKey('owner'));
        $this->sut->searchByOwner($this->createStub(ObjectIdInterface::class));
    }

    public function testSearchByNegotiator()
    {
        $this->repo->expects($this->once())
                ->method('search')
                ->with($this->arrayHasKey('negotiator'));
        $this->sut->searchByNegociator($this->createStub(ObjectIdInterface::class));
    }

}
