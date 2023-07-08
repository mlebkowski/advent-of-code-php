<?php

declare(strict_types=1);

namespace App\Realms\Computing\Processor;

enum Register: string
{
    case A = 'a';
    case B = 'b';
    case C = 'c';
    case D = 'd';
    case F = 'f';
    case I = 'i';
    case P = 'p';
}
