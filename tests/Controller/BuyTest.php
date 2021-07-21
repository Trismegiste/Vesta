<?php

/*
 * Vesta
 */

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BuyTest extends WebTestCase
{

    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/listing');
        $this->assertResponseIsSuccessful();
        $this->assertPageTitleContains('Résultat');
    }

}
