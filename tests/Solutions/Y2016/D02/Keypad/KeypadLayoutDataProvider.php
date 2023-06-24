<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D02\Keypad;

final class KeypadLayoutDataProvider
{
    public static function layouts(): iterable
    {
        yield [
            <<<EOF
            1 2 3
            4 5 6
            7 8 9
            EOF,
            [['1', '2', '3'], ['4', '5', '6'], ['7', '8', '9']],
            [1, 1],
        ];
        yield [
            <<<EOF
                1
              2 3 4
            5 6 7 8 9
              A B C
                D
            EOF,
            [
                [2 => '1'],
                [1 => '2', 2 => '3', 3 => '4'],
                ['5', '6', '7', '8', '9'],
                [1 => 'A', 2 => 'B', 3 => 'C'],
                [2 => 'D'],
            ],
            [2, 0],
        ];
    }
}
