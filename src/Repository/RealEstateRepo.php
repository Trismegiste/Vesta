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
        $tmp = [];
        for ($k = 0; $k < random_int(10, 20); $k++) {
            $obj = new \App\Entity\RealEstate();
            $obj->setTitle($this->getRandomString(random_int(30, 50)));
            $obj->setDescription($this->getRandomString(random_int(200, 400)));
            for ($t = 0; $t < random_int(2, 6); $t++) {
                $obj->addTag($this->getRandomString(random_int(3, 8)));
            }
            $obj->setPrice(1000 * random_int(80, 700));

            array_push($tmp, $obj);
        }

        return new \ArrayIterator($tmp);
    }

    public function searchAutocomplete(string $field, string $startWith, int $limit = 20)
    {
        
    }

    protected function getRandomString(int $n): string
    {
        return str_shuffle(str_repeat(' ', $n / 6) . base64_encode(random_bytes($n)));
    }

}
