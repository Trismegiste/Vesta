<?php

/*
 * Vesta
 */

namespace App\Repository;

use Iterator;
use Trismegiste\Toolbox\MongoDb\Repository;
use Trismegiste\Toolbox\MongoDb\Root;

/**
 * Repository for RealEstate
 *
 * @author flo
 */
class RealEstateRepo implements Repository
{

    public function delete($documentOrArray): void
    {
        
    }

    public function load(string $pk): Root
    {
        
    }

    public function save($documentOrArray): void
    {
        
    }

    public function search(array $filter = [], array $excludedField = [], string $descendingSortField = null): Iterator
    {
        return new \ArrayIterator([1]);
    }

    public function searchAutocomplete(string $field, string $startWith, int $limit = 20)
    {
        
    }

}
