<?php

/*
 * Vesta
 */

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * FrontTest tests the Front
 */
class FrontTest extends WebTestCase
{

    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $this->assertPageTitleContains('Bienv');
    }

}
