<?php

/*
 * Vesta
 */

use Trismegiste\SymfoTools\Repository\YamlRepository;
use PHPUnit\Framework\TestCase;

class YamlRepositoryTest extends TestCase
{

    protected $sut;

    protected function setUp(): void
    {
        $this->sut = new YamlRepository(__DIR__ . '/test_repo.yml');
    }

    public function testFindAll()
    {
        $listing = $this->sut->findAll('section9');
        $this->assertCount(3, $listing);
        $this->assertArrayHasKey('Motoko', $listing);
        $this->assertEquals('Motoko', $listing['Motoko']);
    }

    public function testNotFound()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->sut->findAll('notdefined');
    }

}
