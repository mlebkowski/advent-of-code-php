<?php

declare(strict_types=1);

namespace App\Aoc;

final class Runner
{
    public static function run(
        Solution $solution,
        Challenge $challenge,
        string $title,
        string $input,
        string $expected = '',
    ): void {
        echo "Solving $title\n";
        if ($expected) {
            echo "Expecting: {$expected}\n";
        }
        echo "Result: ";
        $actual = $solution->solve($challenge, $input);
        echo "\033[K", $actual, "\n\n";
        if ($expected && ((string)$actual !== $expected)) {
            exit;
        }
    }
}
