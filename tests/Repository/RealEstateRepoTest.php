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
                ->method('search');
        $this->sut->searchByOwner(new MongoDB\BSON\ObjectId());
    }

    public function testSearchByNegotiator()
    {
        $this->repo->expects($this->once())
                ->method('search');
        $this->sut->searchByNegociator(new MongoDB\BSON\ObjectId());
    }

}
