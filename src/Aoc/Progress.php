<?php

declare(strict_types=1);

namespace App\Aoc;

final class Progress
{
    private int $iteration = 0;
    private readonly int $iterationPadding;

    public static function ofExpectedIterations(int $expectedIterations): self
    {
        $start = microtime(true);
        return new self($expectedIterations, $start);
    }

    public function __construct(
        private readonly int $expectedIterations,
        private readonly float $start,
    ) {
        $this->iterationPadding = (int)floor(log10($this->expectedIterations)) + 1;
    }

    public function step(): true
    {
        $this->iteration++;
        return true;
    }

    public function report(mixed $value): true
    {
        $percentage = $this->iteration / $this->expectedIterations;
        $elapsed = microtime(true) - $this->start;
        $expectedTime = (round($elapsed) / $percentage) * (1 - $percentage);

        $meta = sprintf(
            '[ %s / %s / %s ]',
            str_pad((string)$this->iteration, $this->iterationPadding, pad_type: STR_PAD_LEFT),
            $percentage > 1 ? '??%' : sprintf('% 2.0f%%', $percentage * 100),
            $percentage > 1 ? '??s' : sprintf('%ds', $expectedTime),
        );

        Output::step($value, $meta);
        return true;
    }

    public function delay(int $delay): callable
    {
        return static function () use ($delay) {
            usleep($delay);
            return true;
        };
    }
}
