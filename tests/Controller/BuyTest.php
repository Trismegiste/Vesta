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
        $crawler = $client->request('GET', '/search');
        $this->assertResponseIsSuccessful();
        $this->assertPageTitleContains('Recherchez');
        $buttonCrawlerNode = $crawler->selectButton('search[search]');
        $this->assertCount(1, $buttonCrawlerNode);
    }

    protected function createRealEstate(string $city): \App\Entity\RealEstate
    {
        $re = new \App\Entity\RealEstate();
        $info = new \App\Entity\AppartDescr();
        $info->room = 5;
        $info->carrezArea = 55;
        $re->setCity($city);
        $re->setAppartDescr($info);

        return $re;
    }

    public function testSearchCity()
    {
        $client = static::createClient();
        $repo = static::getContainer()->get('app.realestate.repository');
        $repo->save($this->createRealEstate('nissa'));

        $crawler = $client->request('GET', '/search');
        $buttonCrawlerNode = $crawler->selectButton('search[search]');
        $form = $buttonCrawlerNode->form();
        $form['search[city]'] = 'nissa';
        $crawler = $client->submit($form);
        $this->assertPageTitleContains('Résultat');
        $this->assertCount(1, $crawler->filter('section.listing article.realestate'));
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
