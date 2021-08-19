<?php

namespace App\Tests\Command;

use App\Entity\Negotiator;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Tester\CommandTester;
use Trismegiste\Toolbox\MongoDb\DefaultRepository;

class CreateUserTest extends KernelTestCase
{

    const username = 'test';
    const negotiator = 'nego';
    const password = 'pwd';

    protected function setUp(): void
    {
        static::bootKernel();
    }

    public function testInitialize()
    {
        /* @var $repo DefaultRepository */
        $repo = self::$container->get('app.user.repository');
        $users = iterator_to_array($repo->search([]));
        if (count($users)) {
            $repo->delete($users);
        }
        $this->assertCount(count($users), $users);
    }

    public function testCreateSimpleUser()
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('app:create-user');
        $commandTester = new CommandTester($command);
        $commandTester->setInputs([self::password]);

        $commandTester->execute([
            'user' => self::username,
            'role' => 'USER'
        ]);

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString(self::username, $output);

        $repo = self::$container->get('app.user.repository');
        $iter = $repo->search(['username' => self::username]);
        $found = iterator_to_array($iter);
        $this->assertCount(1, $found);
        $user = $found[0];
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals(self::username, $user->getUsername());
    }

    public function testCreateNegotiator()
    {
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('app:create-user');
        $commandTester = new CommandTester($command);
        $commandTester->setInputs([self::password, 'nissa']);
        $commandTester->execute([
            'user' => self::negotiator,
            'role' => 'NEGOTIATOR'
        ]);

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString(self::negotiator, $output);

        $repo = self::$container->get('app.user.repository');
        $iter = $repo->search(['username' => self::negotiator]);
        $found = iterator_to_array($iter);
        $this->assertCount(1, $found);
        $user = $found[0];
        $this->assertInstanceOf(Negotiator::class, $user);
        $this->assertEquals(self::negotiator, $user->getUsername());
    }

    public function testBadRole()
    {
        $this->expectException(InvalidArgumentException::class);
        $kernel = static::createKernel();
        $application = new Application($kernel);

        $command = $application->find('app:create-user');
        $commandTester = new CommandTester($command);
        $commandTester->setInputs([self::password, 'nissa']);
        $commandTester->execute([
            'user' => self::username,
            'role' => 'YOLO'
        ]);
    }

}
