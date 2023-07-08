<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D17;

final class CircularBufferSimulator
{
    private int $position = 0;
    private ?int $secondValue = null;
    private int $bufferSize = 0;

    public static function of(int $step): self
    {
        return new self($step);
    }

    private function __construct(private readonly int $step)
    {
    }

    public function count(): int
    {
        return $this->bufferSize;
    }

    public function position(): int
    {
        return $this->position;
    }

    public function iterate(): void
    {
        if (0 === $this->bufferSize) {
            $this->bufferSize = 1;
            return;
        }

        $slotsAvailable = $this->bufferSize;
        $slotsLeft = max(0, $slotsAvailable - $this->position - 1);

        $position = $this->step - $slotsLeft % $this->step;
        if ($position > $slotsAvailable) {
            $position = $position % $slotsAvailable ?: $slotsAvailable;
        }
        $this->position = $position;

        $this->bufferSize += (int)floor($slotsLeft / $this->step) + 1;
        if ($this->position === 1) {
            $this->secondValue = $this->bufferSize - 1;
        }
    }

    public function secondValue(): ?int
    {
        return $this->secondValue;
    }
}
