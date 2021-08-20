<?php

use App\Repository\Storage;
use MongoDB\BSON\ObjectIdInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\StreamedResponse;

/*
 * Vesta
 */

class StorageTest extends KernelTestCase
{

    protected Storage $sut;

    protected function setUp(): void
    {
        static::bootKernel();
        $this->sut = static::getContainer()->get('app.storage');
    }

    public function testUpload()
    {
        $pk = $this->sut->storeUploaded(new UploadedFile(__FILE__, 'yolo.txt'));
        $this->assertInstanceOf(ObjectIdInterface::class, $pk);

        return $pk;
    }

    /**
     * @depends testUpload
     */
    public function testDownlad($pk)
    {
        $response = $this->sut->get($pk);
        $this->assertInstanceOf(StreamedResponse::class, $response);
        $response->sendContent();
    }

}
