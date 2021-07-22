<?php

/*
 * Vesta
 */

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Extension for Twig
 */
class AppExtension extends AbstractExtension
{

    public function getFunctions()
    {
        return [
            new TwigFunction('crc_hue', [$this, 'getHue']),
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

        return 360.0 * $hue / 16;
    }

}
