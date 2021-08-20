<?php

use App\Repository\Storage;
use MongoDB\BSON\ObjectIdInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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

    public function testWrite()
    {
        $pk = $this->sut->storeUploaded(new UploadedFile(__FILE__, 'yolo.txt'));
        $this->assertInstanceOf(ObjectIdInterface::class, $pk);
    }

}
