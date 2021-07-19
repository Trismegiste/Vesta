<?php

/*
 * Vesta
 */

namespace App\Tests\Controller;

/**
 * Description of SecurityTest
 *
 * @author flo
 */
class SecurityTest extends \Symfony\Bundle\FrameworkBundle\Test\WebTestCase
{

    use \App\Tests\Controller\SecuredClientImpl;

    public function testLogin()
    {
        $client = static::getAuthenticatedClient();
        $client->request('GET', '/');
        $this->assertPageTitleContains('Bienv');
    }

}
