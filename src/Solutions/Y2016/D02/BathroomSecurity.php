<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D02;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Solutions\Y2016\D02\Keypad\Keypad;

/** @implements Solution<BathroomSecurityInput> */
final class BathroomSecurity implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2016, 02);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): string
    {
        $standardLayout = <<<EOF
        1 2 3
        4 5 6
        7 8 9
        EOF;
        $betterKeypadDesign = <<<EOF
            1
          2 3 4
        5 6 7 8 9
          A B C
            D
        EOF;

        $layout = $challenge->isPartOne() ? $standardLayout : $betterKeypadDesign;

        $result = '';
        $keypad = Keypad::ofLayout($layout);
        foreach ($input->moves as $move) {
            foreach ($move->directions as $direction) {
                $keypad = $keypad->move($direction);
            }
            $result .= $keypad->value();
        }
        return $result;
    }
}
