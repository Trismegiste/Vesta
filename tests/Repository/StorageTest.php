<?php

use App\Repository\Storage;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\ObjectIdInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    public function testNotFound()
    {
        $this->expectException(NotFoundHttpException::class);
        $this->sut->get(new ObjectId());
    }

    public function testSearchByMime()
    {
        $it = $this->sut->searchByMimeType('image/jpeg');
        $this->assertIsIterable($it);
    }

    public function testDelete()
    {
        $it = $this->sut->searchByMimeType('image/jpeg');
        foreach ($it as $img) {
            $this->sut->delete($img['_id']);
        }
        $it = $this->sut->searchByMimeType('image/jpeg');
        $this->assertCount(0, $it);
    }

}
