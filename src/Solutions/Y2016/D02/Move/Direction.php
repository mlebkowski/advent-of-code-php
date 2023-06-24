<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D02\Move;

enum Direction: string
{
    case Up = 'U';
    case Down = 'D';
    case Left = 'L';
    case Right = 'R';
}
