<?php

/*
 * Vesta
 */

class UserTest extends \PHPUnit\Framework\TestCase
{

    protected $sut;

    protected function setUp(): void
    {
        $this->sut = new App\Entity\User('yolo');
    }

    public function testUsername()
    {
        $this->assertEquals('yolo', $this->sut->getUsername());
    }

    public function testUniqueIdentifier()
    {
        $this->assertEquals('yolo', $this->sut->getUserIdentifier());
    }

    public function testPassword()
    {
        $this->sut->setHashedPassword('abc');
        $this->assertEquals('abc', $this->sut->getPassword());
    }

    public function testDefaultRoles()
    {
        $this->assertEquals(['ROLE_USER'], $this->sut->getRoles());
    }

    public function testRoles()
    {
        $this->sut->setRoles(['ROLE_ADMIN']);
        $this->assertEquals(['ROLE_ADMIN'], $this->sut->getRoles());
    }

}
