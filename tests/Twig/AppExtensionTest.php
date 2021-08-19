<?php

/*
 * Vesta
 */

use App\Entity\RealEstate;
use App\Tests\Entity\RealEstateFixture;
use App\Twig\AppExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\Translation\TranslatorInterface;

class AppExtensionTest extends TestCase
{

    use RealEstateFixture;

    protected $sut;

    protected function setUp(): void
    {
        $trans = $this->createStub(TranslatorInterface::class);
        $this->sut = new AppExtension($trans);
    }

    public function testHasFunctions()
    {
        $this->assertCount(1, $this->sut->getFunctions());
    }

    public function testColor()
    {
        $hue = $this->sut->getHue('yolo');
        $this->assertGreaterThanOrEqual(0, $hue);
        $this->assertLessThanOrEqual(360, $hue);
    }

    public function testHasFilters()
    {
        $this->assertCount(1, $this->sut->getFilters());
    }

    public function testCatchline()
    {
        $immo = $this->createRealEstate('nissa');
        $render = $this->sut->getCatchLine($immo);
        $this->assertStringContainsString('Appartement', $render);
        $this->assertStringContainsString('Nissa', $render);
    }

}
