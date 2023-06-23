<?php

declare(strict_types=1);

namespace App\Aoc\Progress;

use Stringable;

final readonly class RemainingTime implements Stringable
{
    public static function of(int $iteration, float $start, ?int $expectedIterations): self
    {
        return new self($iteration, $start, $expectedIterations);
    }

    public function __construct(
        private int   $iteration,
        private float $start,
        private ?int  $expectedIterations,
    ) {
    }

    public function __toString(): string
    {
        $elapsed = microtime(true) - $this->start;
        if (null === $this->expectedIterations) {
            return sprintf('%ds', $elapsed);
        }

        $percentage = $this->iteration / $this->expectedIterations;
        $expectedTime = (round($elapsed) / $percentage) * (1 - $percentage);

        if ($percentage > 1) {
            return '??% / %%s';
        }

        return sprintf(
            '%s / %s',
            sprintf('% 2.0f%%', $percentage * 100),
            sprintf('%ds', $expectedTime),
        );
    }
}
