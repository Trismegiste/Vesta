<?php

/*
 * Vesta
 */

namespace App\Repository;

use Exception;
use MongoDB\BSON\ObjectIdInterface;
use MongoDB\Database;
use MongoDB\Driver\Manager;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use RuntimeException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;

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

        try {
            $id = $this->bucket->uploadFromStream($uf->getFilename(), $stream, ['metadata' => $meta]);
            fclose($stream);
        } catch (Exception $e) {
            throw RuntimeException("Unable to store " . $uf->getClientOriginalName(), 500, $e);
        }

        return $id;
    }

    public function get(ObjectIdInterface $pk): Response
    {
        $stream = $this->bucket->openDownloadStream($pk);
        $metadata = $this->bucket->getFileDocumentForStream($stream);

        $response = new StreamedResponse(function () use ($stream) {
                    fpassthru($stream);
                });
        $response->setImmutable();
        $response->setDate($metadata->uploadDate->toDateTime());

        return $response;
    }

}
