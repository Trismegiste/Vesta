<?php

/*
 * VirImmo
 */

use App\Entity\RealEstate;
use App\Repository\RealEstateRepo;
use MongoDB\Driver\Manager;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

/**
 * Description of RealEstateRepoTest
 *
 * @author flo
 */
class RealEstateRepoTest extends TestCase
{

    protected $sut;
    protected $mongo;
    protected $logger;

    protected function setUp(): void
    {
        $this->mongo = new Manager('mongodb://localhost:27017');
        $this->logger = $this->createMock(LoggerInterface::class);
        $this->sut = new RealEstateRepo($this->mongo, 'virimmo', 'repo_test', $this->logger);
    }

    public function testWrite()
    {
        $obj = new RealEstate();
        $this->sut->save($obj);
    }

}
