<?php

declare(strict_types=1);

namespace App\Aoc\Progress;

use App\Aoc\Output;
use Closure;

final class Progress
{
    private int $iteration = 0;
    private bool $memoryUsage = false;
    private int $iterationPadding;
    private int $inSteps = 1;
    private int $delay = 0;
    private static int $dieAfter = 0;

    public static function dieAfter(int $max): void
    {
        self::$dieAfter = $max;
    }

    public static function ofExpectedIterations(int $expectedIterations): self
    {
        $start = microtime(true);
        return new self($expectedIterations, $start);
    }

    public static function unknown(): self
    {
        $start = microtime(true);
        return new self(null, $start);
    }

    private function __construct(
        private readonly null|int $expectedIterations,
        private readonly float $start,
    ) {
        $this->calculateIterationPadding();
    }

    public function reportInSteps(int $steps): self
    {
        $this->inSteps = $steps;
        $this->calculateIterationPadding();
        return $this;
    }

    public function withMemoryUsage(): self
    {
        $this->memoryUsage = true;
        return $this;
    }

    public function withDelay(int $delay): self
    {
        $this->delay = $delay;
        return $this;
    }

    public function step(): true
    {
        $this->delay && usleep($this->delay);
        $this->iteration++;
        if (self::$dieAfter && $this->iteration >= self::$dieAfter) {
            exit("\n\033[1;31mReached {$this->iteration} iterations\033[0m\n");
        }
        return true;
    }

    public function report(mixed $value): true
    {
        if ($this->iteration % $this->inSteps) {
            return true;
        }

        $parts = [];
        if ($this->memoryUsage) {
            $parts[] = new MemoryUsage();
        }

        $parts[] = str_pad(
            number_format($this->iteration / $this->inSteps, thousands_separator: ' '),
            $this->iterationPadding,
            pad_type: STR_PAD_LEFT,
        );

        $parts[] = new RemainingTime($this->iteration, $this->start, $this->expectedIterations);

        if ($value instanceof Closure) {
            $value = $value();
        }
        Output::step($value, sprintf('[ %s ]', implode(' / ', $parts)));
        return true;
    }

    private function calculateIterationPadding(): void
    {
        if (null === $this->expectedIterations) {
            $this->iterationPadding = 0;
            return;
        }

        assert($this->expectedIterations > 0);
        $iterationPadding = (int)floor(log10($this->expectedIterations / $this->inSteps)) + 1;
        $iterationPadding += floor(($iterationPadding - 1) / 3);
        $this->iterationPadding = (int)$iterationPadding;
    }
}
