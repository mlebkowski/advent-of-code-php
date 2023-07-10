<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D22;

enum InfectionState: string
{
    case Infected = "#";
    case Weakened = "W";
    case Flagged = "F";
    case Clean = '.';
}
