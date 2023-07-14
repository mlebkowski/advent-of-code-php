<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D16;

use PHPUnit\Framework\TestCase;

final class UniqueMappingTest extends TestCase
{
    public function test(): void
    {
        $given = [
            0 =>
                [
                    2 => 'bani',
                    3 => 'banr',
                    4 => 'bori',
                    6 => 'eqir',
                    7 => 'eqri',
                    12 => 'muli',
                    15 => 'setr',
                ],
            1 =>
                [
                    2 => 'bani',
                    3 => 'banr',
                    6 => 'eqir',
                    7 => 'eqri',
                    8 => 'eqrr',
                    9 => 'gtir',
                    10 => 'gtri',
                    11 => 'gtrr',
                    12 => 'muli',
                    13 => 'mulr',
                    14 => 'seti',
                    15 => 'setr',
                ],
            2 =>
                [
                    3 => 'banr',
                    6 => 'eqir',
                    7 => 'eqri',
                    8 => 'eqrr',
                    9 => 'gtir',
                    10 => 'gtri',
                    11 => 'gtrr',
                ],
            3 =>
                [
                    2 => 'bani',
                    3 => 'banr',
                    6 => 'eqir',
                    7 => 'eqri',
                    8 => 'eqrr',
                    9 => 'gtir',
                    10 => 'gtri',
                    11 => 'gtrr',
                ],
            4 =>
                [
                    6 => 'eqir',
                    7 => 'eqri',
                    8 => 'eqrr',
                    9 => 'gtir',
                    10 => 'gtri',
                    11 => 'gtrr',
                ],
            5 =>
                [
                    9 => 'gtir',
                    15 => 'setr',
                ],
            6 =>
                [
                    1 => 'addr',
                    2 => 'bani',
                    3 => 'banr',
                    5 => 'borr',
                    7 => 'eqri',
                    9 => 'gtir',
                    10 => 'gtri',
                    11 => 'gtrr',
                    12 => 'muli',
                    13 => 'mulr',
                    14 => 'seti',
                    15 => 'setr',
                ],
            7 =>
                [
                    6 => 'eqir',
                    7 => 'eqri',
                    8 => 'eqrr',
                ],
            8 =>
                [
                    2 => 'bani',
                    3 => 'banr',
                    6 => 'eqir',
                    7 => 'eqri',
                    8 => 'eqrr',
                    9 => 'gtir',
                    10 => 'gtri',
                    11 => 'gtrr',
                    14 => 'seti',
                ],
            9 =>
                [
                    0 => 'addi',
                    1 => 'addr',
                    2 => 'bani',
                    3 => 'banr',
                    4 => 'bori',
                    5 => 'borr',
                    9 => 'gtir',
                    10 => 'gtri',
                    11 => 'gtrr',
                    12 => 'muli',
                    13 => 'mulr',
                    14 => 'seti',
                    15 => 'setr',
                ],
            10 =>
                [
                    7 => 'eqri',
                    8 => 'eqrr',
                ],
            11 =>
                [
                    7 => 'eqri',
                ],
            12 =>
                [
                    2 => 'bani',
                    3 => 'banr',
                    4 => 'bori',
                    5 => 'borr',
                    6 => 'eqir',
                    7 => 'eqri',
                    8 => 'eqrr',
                    12 => 'muli',
                    13 => 'mulr',
                    14 => 'seti',
                    15 => 'setr',
                ],
            13 =>
                [
                    6 => 'eqir',
                    7 => 'eqri',
                    10 => 'gtri',
                    11 => 'gtrr',
                ],
            14 =>
                [
                    2 => 'bani',
                    3 => 'banr',
                    7 => 'eqri',
                    8 => 'eqrr',
                    9 => 'gtir',
                    10 => 'gtri',
                    13 => 'mulr',
                    14 => 'seti',
                ],
            15 =>
                [
                    6 => 'eqir',
                    8 => 'eqrr',
                    10 => 'gtri',
                ],
        ];
        $actual = UniqueMapping::deduce($given);
        self::assertSame(
            [
                0 => OpcodeName::Bori,
                1 => OpcodeName::Muli,
                2 => OpcodeName::Banr,
                3 => OpcodeName::Bani,
                4 => OpcodeName::Gtir,
                5 => OpcodeName::Setr,
                6 => OpcodeName::Addr,
                7 => OpcodeName::Eqir,
                8 => OpcodeName::Seti,
                9 => OpcodeName::Addi,
                10 => OpcodeName::Eqrr,
                11 => OpcodeName::Eqri,
                12 => OpcodeName::Borr,
                13 => OpcodeName::Gtrr,
                14 => OpcodeName::Mulr,
                15 => OpcodeName::Gtri,
            ],
            $actual,
        );
    }
}
