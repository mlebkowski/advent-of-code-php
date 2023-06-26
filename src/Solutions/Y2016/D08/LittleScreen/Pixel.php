<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D08\LittleScreen;

enum Pixel: string
{
    case On = '█';
    case Off = ' ';

    public function isLit(): bool
    {
        return $this === Pixel::On;
    }
}
