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
        for ($k = 0; $k < 10; $k++) {
            $obj = new \App\Entity\RealEstate();
            $obj->setTitre($this->getRandomString(random_int(30, 50)));
            $obj->setDescription($this->getRandomString(random_int(200, 400)));
            for ($t = 0; $t < 4; $t++) {
                $obj->addTag($this->getRandomString(8));
            }
            $obj->setPrix(1000 * random_int(80, 700));

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
