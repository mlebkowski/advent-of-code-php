<?php

declare(strict_types=1);

namespace App\Aoc\Runner;

use App\Aoc\Challenge;
use App\Aoc\Solution;

final readonly class Runner
{
    public function __construct(private ChallengeInputParser $inputParser)
    {
    }

    public function run(
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
        $actual = $solution->solve($challenge, $this->inputParser->parseInput($solution, $input));
        echo "\033[K", $actual, "\n\n";
        if ($expected && ((string)$actual !== $expected)) {
            exit;
        }
    }
}
