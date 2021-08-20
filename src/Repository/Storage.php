<?php

/*
 * Vesta
 */

namespace App\Repository;

use MongoDB\BSON\ObjectIdInterface;
use MongoDB\Database;
use MongoDB\Driver\Manager;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * This is a storage engine on MongoDB
 */
class Storage
{

    protected $bucket;
    protected $logger;

    public function __construct(Manager $manager, string $dbName, LoggerInterface $log = null)
    {
        $db = new Database($manager, $dbName);
        $this->bucket = $db->selectGridFSBucket();
        $this->logger = is_null($log) ? new NullLogger() : $log;
    }

    public function storeUploaded(UploadedFile $uf, array $meta = []): ObjectIdInterface
    {
        $stream = fopen($uf->getPathname(), 'rb');
        $meta['mime'] = $uf->getMimeType();
        $id = $this->bucket->uploadFromStream($uf->getFilename(), $stream, ['metadata' => $meta]);
        fclose($stream);

        return $id;
    }

}
