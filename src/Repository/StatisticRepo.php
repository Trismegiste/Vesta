<?php

/*
 * Vesta
 */

namespace App\Repository;

use MongoDB\Driver\BulkWrite;
use MongoDB\Driver\Manager;
use MongoDB\Driver\Query;

/**
 * This is a repo for storing/managing statistics on entities
 */
class StatisticRepo
{

    protected $manager;
    protected $collectionName;

    public function __construct(Manager $mongo, string $dbName, string $collName)
    {
        $this->manager = $mongo;
        $this->collectionName = $dbName . '.' . $collName;
    }

    public function incCounter(string $entity, string $pk): void
    {
        $bulk = new BulkWrite();
        $bulk->update(
                [
                    'key' => $pk,
                    'entity' => $entity
                ],
                ['$inc' => ['counter' => 1]],
                ['upsert' => true]
        );
        $this->manager->executeBulkWrite($this->collectionName, $bulk);
    }

    public function getCounter(string $entity, string $pk)
    {
        $cursor = $this->manager->executeQuery($this->collectionName, new Query([
                    'key' => $pk,
                    'entity' => $entity
        ]));
        
        foreach ($cursor as $cnt) {
            return $cnt->counter;
        }
    }

}
