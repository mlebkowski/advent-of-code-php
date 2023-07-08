<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D17;

final class CircularBuffer
{
    private array $values = [];
    private int $position = 0;

    public static function of(int $step): self
    {
        return new self($step);
    }

    public static function simulate(int $step): CircularBufferSimulator
    {
        return CircularBufferSimulator::of($step);
    }

    private function __construct(private readonly int $step)
    {
    }

    public function iterate(): self
    {
        if (!$this->values) {
            $this->values[] = 0;
            return $this;
        }

        $this->position = ($this->position + $this->step) % count($this->values) + 1;
        array_splice($this->values, $this->position, 0, [count($this->values)]);
        return $this;
    }

    public function values(): array
    {
        return $this->values;
    }

    public function position(): int
    {
        return $this->position;
    }

    public function after(int $search): int
    {
        $idx = array_search($search, $this->values, true);
        return $this->values[$idx + 1];
    }
}
