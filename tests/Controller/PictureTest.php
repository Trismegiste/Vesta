<?php

/*
 * Vesta
 */

namespace App\Tests\Controller;

use App\Repository\Storage;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use function join_paths;

class PictureTest extends WebTestCase
{

    protected KernelBrowser $client;
    protected Storage $repo;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repo = static::getContainer()->get('App\Repository\Storage');
    }

    public function testGetPicture()
    {
        $crawler = $this->client->request('GET', '/picture/123456789012345678901234');
        $this->assertResponseStatusCodeSame(404);
    }

    public function testCachedResponse()
    {
        $this->repo->storeUploaded(new UploadedFile(join_paths(__DIR__, '../Repository/image.jpg'), 'functest.jpg'));
    }

}
