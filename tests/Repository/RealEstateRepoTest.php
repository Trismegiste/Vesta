<?php

/*
 * Vesta
 */

use App\Entity\RealEstate;
use App\Repository\RealEstateRepo;
use MongoDB\Driver\Manager;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Tests\Toolbox\MongoDb\MongoCheck;

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
    protected $logger;

    protected function setUp(): void
    {
        $this->mongo = new Manager('mongodb://localhost:27017');
        $this->logger = $this->createMock(LoggerInterface::class);
        $this->sut = new RealEstateRepo($this->mongo, 'virimmo', 'repo_test', $this->logger);
        $this->ping($this->mongo, 'virimmo');
    }

    public function testWrite()
    {
        $obj = new RealEstate();
        $obj->setAddress("42 av. First Street");
        $obj->setPostalCode("06000");
        $obj->setCity("Nissa la Bella");
        $this->sut->save($obj);
    }

}
