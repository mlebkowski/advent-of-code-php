<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D09\Parser;

enum Type
{
    case GroupStart;
    case GroupEnd;
    case Delimiter;
    case Garbage;
}
