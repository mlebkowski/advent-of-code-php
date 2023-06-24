<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D02;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Solutions\Y2016\D02\Keypad\B5;

/** @implements Solution<BathroomSecurityInput> */
final class BathroomSecurity implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2016, 02);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): string
    {
        $result = '';
        $button = new B5();
        foreach ($input->moves as $move) {
            foreach ($move->directions as $direction) {
                $button = $button->move($direction);
            }
            $result .= $button->value();
        }
        return $result;
    }
}
