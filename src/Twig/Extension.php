<?php

/*
 * Vesta
 */

namespace Trismegiste\SymfoTools\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Extension for Twig
 */
class Extension extends AbstractExtension
{

    public function getFilters(): array
    {
        return [
            new TwigFilter('filesize', [$this, 'getFileSize']),
        ];
    }

    const coeff = ['', 'k', 'M', 'G', 'T', 'P'];

    public function getFileSize(int $num): string
    {
        if ($num < 0) {
            return (string) $num;
        }

        $multiplier = (int) floor(log10($num) / 3);  // Yeah, I'm that S.I. guy, meaning 1 kB = 1000 Bytes

        return sprintf($multiplier !== 0 ? '%.2f %sB' : '%d B', \round($num / (10 ** (3 * $multiplier)), 2), self::coeff[$multiplier]);
    }

}
