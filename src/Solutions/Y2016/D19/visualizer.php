<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D19;

const Start = "'";
const Middle = "-";
const End = '^';
const ColumnWidth = 3;
const Count = 8;

echo implode(
    "",
    array_map(
        static fn (int $n) => str_pad((string)$n, ColumnWidth),
        range(1, Count),
    ),
),
"\n";

$pad = static fn (int $n) => str_pad((string)$n, 3, ' ', STR_PAD_BOTH);
$elves = range(1, Count);
while (count($elves) > 1) {
    $elf = array_shift($elves);
    $across = (int)ceil(count($elves) / 2) - 1;
    $comment = Count >= 10 ? '' : sprintf(
        ' % 3d → %s',
        $elf,
        str_pad(
            implode(' ', array_filter([
                implode(' ', array_map($pad, array_slice($elves, 0, $across))),
                '(' . $elves[$across] . ')',
                implode(' ', array_map($pad, array_slice($elves, $across + 1))),
            ])),
            length: Count * 4,
            pad_type: STR_PAD_BOTH,
        ),
    );
    [$takesFrom] = array_splice($elves, $across, 1);
    $elves = [...$elves, $elf];

    $arrow = implode(
        str_repeat(Middle, (abs($elf - $takesFrom) - 1) * ColumnWidth + 2),
        $elf > $takesFrom ? [End, Start] : [Start, End],
    );
    $offset = (min($elf, $takesFrom) - 1) * ColumnWidth;

    echo str_pad(
        substr_replace(str_repeat(' ', $offset), $arrow, $offset, strlen($arrow)),
        Count * ColumnWidth,
    ),
    $comment,
    "\n";
}

$count = Count;
echo "\nWith $count elves the winner is → " . reset($elves), "\n";
