<?php

/*
 * Vesta
 */

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class StatisticRepoTest extends KernelTestCase
{

    /** @var App\Repository\StatisticRepo  */
    protected $sut;

    protected function setUp(): void
    {
        static::bootKernel();
        $this->sut = static::getContainer()->get('App\Repository\StatisticRepo');
    }

    public function testNonExisting()
    {
        $this->assertEquals(0, $this->sut->getCounter('abcd', '123'));
    }

    public function testInc()
    {
        $start = $this->sut->getCounter('y', '123');
        $this->sut->incCounter('y', '123');
        $this->assertEquals($start + 1, $this->sut->getCounter('y', '123'));
    }

}
