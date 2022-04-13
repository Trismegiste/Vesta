<?php

/*
 * SymfoTools
 */

use PHPUnit\Framework\TestCase;
use Trismegiste\SymfoTools\Twig\Extension;

class ExtensionTest extends TestCase
{

    protected $sut;

    protected function setUp(): void
    {
        $this->sut = new Extension();
    }

    public function testThreeDigitFileSize()
    {
        $this->assertEquals('1 B', $this->sut->getFileSize(1));
        $this->assertEquals('19 B', $this->sut->getFileSize(19));
        $this->assertEquals('999 B', $this->sut->getFileSize(999));
        $this->assertEquals('1.00 kB', $this->sut->getFileSize(1000));
        $this->assertEquals('1.59 kB', $this->sut->getFileSize(1594));
        $this->assertEquals('1.60 kB', $this->sut->getFileSize(1595));
        $this->assertEquals('1.00 MB', $this->sut->getFileSize(1000000));
        $this->assertEquals('2.00 MB', $this->sut->getFileSize(1999999));
        $this->assertEquals('1.23 PB', $this->sut->getFileSize(1.23e15));
        $this->assertEquals('-6666', $this->sut->getFileSize(-6666));
    }

}
