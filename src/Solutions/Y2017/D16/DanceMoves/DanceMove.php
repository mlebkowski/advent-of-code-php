<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D16\DanceMoves;

interface DanceMove
{
    public function apply(array $programs): array;
}
