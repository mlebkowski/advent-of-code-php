<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D17;

final class CircularBuffer
{
    private array $value = [];
    private int $position = 0;

    public static function of(int $step): self
    {
        return new self($step);
    }

    private function __construct(private readonly int $step)
    {
    }

    public function iterate(): self
    {
        if (!$this->value) {
            $this->value[] = 0;
            return $this;
        }

        $this->position = ($this->position + $this->step) % count($this->value) + 1;
        array_splice($this->value, $this->position, 0, [count($this->value)]);
        return $this;
    }

    public function values(): array
    {
        return $this->value;
    }
}
