<?php

/*
 * Vesta
 */

use App\Twig\AppExtension;
use PHPUnit\Framework\TestCase;

class AppExtensionTest extends TestCase
{

    protected $sut;

    protected function setUp(): void
    {
        $this->sut = new AppExtension();
    }

    public function testHasFunctions()
    {
        $this->assertNotEmpty($this->sut->getFunctions());
    }

    public function testColor()
    {
        $hue = $this->sut->getHue('yolo');
        $this->assertGreaterThanOrEqual(0, $hue);
        $this->assertLessThanOrEqual(360, $hue);
    }

}
