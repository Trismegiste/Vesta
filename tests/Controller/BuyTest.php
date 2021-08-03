<?php

/*
 * Vesta
 */

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BuyTest extends WebTestCase
{

    public function testSearchEmpty()
    {
        $client = static::createClient();
        $client->request('GET', '/search');
        $this->assertResponseIsSuccessful();
        $this->assertPageTitleContains('Recherchez');
    }

    public function testVisit()
    {
        $client = static::createClient();
        $client->request('GET', '/visit/123456789012345678901234');
        $this->assertResponseIsSuccessful();
    }

    public function testDetail()
    {
        $client = static::createClient();
        $client->request('GET', '/detail/123456789012345678901234');
        $this->assertResponseIsSuccessful();
    }

}
