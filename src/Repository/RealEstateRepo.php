<?php

/*
 * Vesta
 */

namespace App\Repository;

use App\Entity\RealEstate;
use Iterator;
use MongoDB\BSON\ObjectIdInterface;
use Trismegiste\Toolbox\MongoDb\Repository;

/**
 * Repository for RealEstate
 */
class RealEstateRepo
{

    protected $repo;

    public function __construct(Repository $realRepo)
    {
        $this->repo = $realRepo;
    }

    public function save(RealEstate $re): void
    {
        $this->repo->save($re);
    }

    public function search(array $filter = [], array $excludedField = [], string $descendingSortField = null): Iterator
    {
        return $this->repo->search($filter, $excludedField, $descendingSortField);
    }

    public function findByPk(string $pk)
    {
        return $this->repo->load($pk);
    }

    public function findByOwner(ObjectIdInterface $fk): \Iterator
    {
        return $this->repo->search(['owner' => $fk]);
    }

}
