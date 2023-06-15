<?php

declare(strict_types=1);

namespace App\Aoc\Runner;

use App\Aoc\Solution;

final readonly class ChallengeInputParser
{
    public function __construct(private InputFactory $inputFactory)
    {
    }

    public function parseInput(Solution $challenge, string $input): mixed
    {
        $inputClass = TargetClassEvaluator::getTargetClass($challenge);
        return $this->inputFactory->make($input, $inputClass);
    }
}
