<?php

/*
 * Vesta
 */

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BuyTest extends WebTestCase
{

    public function testListing()
    {
        $client = static::createClient();
        $client->request('GET', '/listing');
        $this->assertResponseIsSuccessful();
        $this->assertPageTitleContains('Résultat');
    }

    public function testDetail()
    {
        $client = static::createClient();
        $client->request('GET', '/detail');
        $this->assertResponseIsSuccessful();
    }

}
