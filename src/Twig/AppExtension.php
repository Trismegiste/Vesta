<?php

/*
 * Vesta
 */

namespace App\Twig;

use App\Entity\RealEstate;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

/**
 * Extension for Twig
 */
class AppExtension extends AbstractExtension
{

    protected $translator;

    public function __construct(TranslatorInterface $translate)
    {
        $this->translator = $translate;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('crc_hue', [$this, 'getHue']),
        ];
    }

    public function getFilters()
    {
        return [
            new TwigFilter('catchline', [$this, 'getCatchLine'])
        ];
    }

    /**
     * Gets a hue between 0 to 360° from a string
     * 
     * @param string $tag
     * @return int
     */
    public function getHue(string $tag): int
    {
        $hue = hexdec(substr(hash('crc32', $tag), 7));

        return (360.0 * $hue) / 16;
    }

    /**
     * Gets the standard advertisement for a RealEstate
     * 
     * @param RealEstate $immo
     * @return string
     */
    public function getCatchLine(RealEstate $immo): string
    {
        return sprintf('%s %s %s %d m² %s %s %s %s',
                $immo->getCategory(),
                lcfirst($immo->getAppartDescr()->condition),
                ucwords($immo->getCity()),
                $immo->getSurface(),
                $this->translator->trans('ROOM_NUMBER', ['room' => $immo->getRoom()]),
                $this->translator->trans('FLOOR_NUMBER', ['floor' => $immo->getFloor()]),
                lcfirst($this->translator->trans('Lighting')),
                $immo->getAppartDescr()->lighting
        );
    }

}
