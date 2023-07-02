<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D19;

const Start = "'";
const Middle = "-";
const End = '^';
const ColumnWidth = 3;
const Count = 28;

echo implode(
    "",
    array_map(
        static fn (int $n) => str_pad((string)$n, ColumnWidth),
        range(1, Count),
    ),
),
"\n";

$elves = range(1, Count);
while (count($elves) > 1) {
    $elf = array_shift($elves);
    $across = (int)ceil(count($elves) / 2) - 1;
    [$takesFrom] = array_splice($elves, $across, 1);
    $elves = [...$elves, $elf];

    $arrow = implode(
        str_repeat(Middle, (abs($elf - $takesFrom) - 1) * ColumnWidth + 2),
        $elf > $takesFrom ? [End, Start] : [Start, End],
    );
    $offset = (min($elf, $takesFrom) - 1) * ColumnWidth;

    echo substr_replace(str_repeat(' ', $offset), $arrow, $offset, strlen($arrow)), "\n";
}

$count = Count;
echo "\nWith $count elves the winner is → " . reset($elves), "\n";
