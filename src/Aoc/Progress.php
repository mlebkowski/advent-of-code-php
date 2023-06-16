<?php

declare(strict_types=1);

namespace App\Aoc;

final class Progress
{
    private int $iteration = 0;
    private readonly int $iterationPadding;
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
        if (null === $this->expectedIterations) {
            $this->iterationPadding = 0;
            return;
        }

        assert($expectedIterations > 0);
        $iterationPadding = (int)floor(log10($expectedIterations)) + 1;
        $iterationPadding += floor(($iterationPadding - 1) / 3);
        $this->iterationPadding = (int)$iterationPadding;
    }

    public function step(): true
    {
        $this->iteration++;
        if (self::$dieAfter && $this->iteration >= self::$dieAfter) {
            exit("\n\033[1;31mReached {$this->iteration} iterations\033[0m\n");
        }
        return true;
    }

    public function report(mixed $value): true
    {
        $elapsed = microtime(true) - $this->start;
        $iteration = str_pad(
            number_format($this->iteration, thousands_separator: ' '),
            $this->iterationPadding,
            pad_type: STR_PAD_LEFT,
        );

        if (null === $this->expectedIterations) {
            $meta = sprintf(
                '[ %s / %ds ]',
                $iteration,
                $elapsed,
            );

            Output::step($value, $meta);
            return true;
        }

        $percentage = $this->iteration / $this->expectedIterations;
        $expectedTime = (round($elapsed) / $percentage) * (1 - $percentage);

        $meta = sprintf(
            '[ %s / %s / %s ]',
            $iteration,
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
