<?php

/*
 * Vesta
 */

namespace App\Repository;

use Exception;
use MongoDB\BSON\ObjectIdInterface;
use MongoDB\Database;
use MongoDB\Driver\Manager;
use MongoDB\GridFS\Bucket;
use MongoDB\GridFS\Exception\FileNotFoundException;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use RuntimeException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * This is a storage engine on MongoDB
 */
class Storage
{

    protected Bucket $bucket;
    protected LoggerInterface $logger;

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
            $this->logger->info("Writing " . $uf->getFilename()); // @todo better info
        } catch (Exception $e) {
            throw new RuntimeException("Unable to store " . $uf->getClientOriginalName(), 500, $e);
        }

        return $id;
    }

    public function get(ObjectIdInterface $pk): Response
    {
        try {
            $stream = $this->bucket->openDownloadStream($pk);
        } catch (FileNotFoundException $e) {
            throw new NotFoundHttpException("Stored object $pk not found");
        }
        $metadata = $this->bucket->getFileDocumentForStream($stream);

        $response = new StreamedResponse(function () use ($stream) {
                    fpassthru($stream);
                });
        $response->setImmutable();
        $response->setDate($metadata->uploadDate->toDateTime());
        $response->headers->set('Content-Type', $metadata->metadata->mime);

        return $response;
    }

    public function delete(ObjectIdInterface $pk)
    {
        $this->bucket->delete($pk);
    }

}
