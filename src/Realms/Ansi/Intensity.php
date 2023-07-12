<?php
declare(strict_types=1);

namespace App\Realms\Ansi;

enum Intensity: int
{
    case Bold = 1;
    case Faint = 2;
    case Reset = 0;
}
