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
        $this->sut = static::getContainer()->get('App\Repository\Storage');
    }

    public function testUpload()
    {
        $pk = $this->sut->storeUploaded(new UploadedFile(join_paths(__DIR__, 'image.jpg'), 'image.jpg'));
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
        ob_start();
        $response->sendContent();
        $dump = ob_get_clean();
        $this->assertEquals(file_get_contents(join_paths(__DIR__, 'image.jpg')), $dump);
    }

}
