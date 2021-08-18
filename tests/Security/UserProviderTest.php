<?php

use App\Entity\Negotiator;
use App\Entity\User;
use App\Security\UserProvider;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Trismegiste\Toolbox\MongoDb\Repository;

/*
 * Vesta
 */

/**
 * Description of UserProviderTest
 *
 * @author flo
 */
class UserProviderTest extends TestCase
{

    protected $sut;

    protected function setUp(): void
    {
        $repo = $this->createStub(Repository::class);
        $log = $this->createStub(LoggerInterface::class);
        $this->sut = new UserProvider($log, $repo);
    }

    public function testNotFoundUser()
    {
        $this->expectException(UserNotFoundException::class);
        $this->sut->loadUserByIdentifier('yolo');
    }

    public function testDeprecatedForCodeCoverage()
    {
        $this->expectException(UserNotFoundException::class);
        $this->sut->loadUserByUsername('test');
    }

    public function testSupportedClass()
    {
        $this->assertTrue($this->sut->supportsClass(User::class));
        $this->assertTrue($this->sut->supportsClass(Negotiator::class));
    }

}
