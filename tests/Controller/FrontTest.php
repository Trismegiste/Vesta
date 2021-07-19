<?php

/*
 * VirImmo
 */

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * FrontTest tests the Front
 */
class FrontTest extends WebTestCase
{

    use App\Tests\Controller\SecuredClientImpl;

    public function testIndex()
    {
        $client = static::getAuthenticatedClient();
        $client->request('GET', '/');
        $this->assertPageTitleContains('Bienv');
    }

}
