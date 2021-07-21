<?php

/*
 * Vesta
 */

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{

    public function getFunctions()
    {
        return [
            new TwigFunction('crc_hue', [$this, 'getHue']),
        ];
    }

    public function getHue(string $tag): int
    {
        $hue = hexdec(substr(hash('crc32', $tag), 7));

        return 360.0 * $hue / 16;
    }

}
