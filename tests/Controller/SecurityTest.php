<?php

/*
 * Vesta
 */

namespace App\Tests\Controller;

use App\Tests\Command\CreateUserTest;

/**
 * Description of SecurityTest
 *
 * @author flo
 */
class SecurityTest extends \Symfony\Bundle\FrameworkBundle\Test\WebTestCase
{

    public function testLogin()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/account/login');
        $loginForm = $crawler->selectButton('Se connecter')->form();
        $client->submit($loginForm, [
            'username' => CreateUserTest::username,
            'password' => CreateUserTest::password,
            'csrf_token' => $loginForm->get('csrf_token')->getValue(),
        ]);

        if ($client->getResponse()->headers->get('Location') === '/account/login') {
            throw new RuntimeException("Bad configuration for TEST : authentication failed");
        }

        $client->request('GET', '/');
        $this->assertPageTitleContains('Bienv');
    }

    public function testLogout()
    {
        $client = static::createClient();
        $repo = static::$container->get('app.user.repository');
        $iter = $repo->search(['username' => CreateUserTest::username]);
        $user = iterator_to_array($iter)[0];
        $client->loginUser($user);
        $this->assertNotNull($client->getContainer()->get('session')->get('_security_main'));
        $client->request('GET', '/logout');
        $this->assertNull($client->getContainer()->get('session')->get('_security_main'));
    }

}
