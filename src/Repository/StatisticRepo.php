<?php

/*
 * Vesta
 */

namespace App\Repository;

use MongoDB\Driver\BulkWrite;
use MongoDB\Driver\Manager;

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

    public function incCounter(string $entity, string $pk)
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

}
