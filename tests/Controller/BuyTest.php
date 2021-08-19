<?php

/*
 * Vesta
 */

namespace App\Tests\Controller;

use App\Entity\AppartDescr;
use App\Entity\RealEstate;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Trismegiste\Toolbox\MongoDb\Repository;

class BuyTest extends WebTestCase
{

    protected KernelBrowser $client;
    protected Repository $repo;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repo = static::getContainer()->get('app.realestate.repository');
    }

    public function testResetRealEstate()
    {
        $all = iterator_to_array($this->repo->search());
        $this->assertIsArray($all);
        $this->repo->delete($all);
    }

    public function testSearchEmpty()
    {
        $crawler = $this->client->request('GET', '/search');
        $this->assertResponseIsSuccessful();
        $this->assertPageTitleContains('Recherchez');
        $buttonCrawlerNode = $crawler->selectButton('search[search]');
        $this->assertCount(1, $buttonCrawlerNode);
    }

    protected function createRealEstate(string $city): RealEstate
    {
        $re = new RealEstate();
        $re->setCategory('Appartement');
        $info = new AppartDescr();
        $info->room = 5;
        $info->carrezArea = 55;
        $info->floor = 3;
        $re->setCity($city);
        $re->setAppartDescr($info);

        return $re;
    }

    public function testSearchCity()
    {
        $this->repo->save($this->createRealEstate('nissa'));

        $crawler = $this->client->request('GET', '/search');
        $buttonCrawlerNode = $crawler->selectButton('search[search]');
        $form = $buttonCrawlerNode->form();
        $form['search[city]'] = 'nissa';
        $crawler = $this->client->submit($form);
        $this->assertPageTitleContains('Résultat');

        $listingNode = $crawler->filter('section.listing');
        $this->assertCount(1, $listingNode, "Listing entry not found");
        $re = $listingNode->filter('article.realestate');
        $this->assertCount(1, $re, 'Real estate not found');
        // choose the first (and only)
        $first = $re->eq(0);
        $this->assertStringContainsString('Appartement', $first->filter('figcaption h3')->text());
        $href = $first->filter('figcaption > a')->attr('href');
        $this->assertStringContainsString('visit', $href);

        return $href;
    }

    /**
     * @depends testSearchCity
     */
    public function testVisit(string $href)
    {
        $crawler = $this->client->request('GET', $href);
        $this->assertResponseIsSuccessful();
        $this->assertStringContainsString('Appartement', $crawler->filter('header.content-header')->text());

        $nav = $crawler->filter('nav.realestate-navicon');
        $detailUrl = $nav->filterXPath('//a[contains(@href, "detail")]')->attr('href');

        return $detailUrl;
    }

    /**
     * @depends testVisit
     */
    public function testDetail($url)
    {
        $crawler = $this->client->request('GET', $url);
        $this->assertResponseIsSuccessful();
        $this->assertStringContainsString('Appartement', $crawler->filter('header.content-header')->text());
    }

}
