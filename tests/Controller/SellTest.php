<?php

/*
 * Vesta
 */

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Description of SellTest
 *
 * @author flo
 */
class SellTest extends WebTestCase
{

    public function testViewSellForm()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/sell');
        $this->assertResponseIsSuccessful();
        $this->assertPageTitleContains('Inscription');
        $buttonCrawlerNode = $crawler->selectButton('real_estate_subscribing[subscribe]');
        $this->assertCount(1, $buttonCrawlerNode);
    }

}
