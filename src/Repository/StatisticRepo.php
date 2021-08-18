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

    public function push(string $entity, string $pk, string $msg, array $ctx = [])
    {
        $bulk = new BulkWrite();
        $bulk->insert([
            'entity' => $entity,
            'key' => $pk,
            'msg' => $msg,
            'ctx' => $ctx
        ]);

        $this->manager->executeBulkWrite($this->collectionName, $bulk);
    }

}
