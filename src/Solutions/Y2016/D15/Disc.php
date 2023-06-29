<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D15;

use Stringable;

final readonly class Disc implements Stringable
{
    public static function of(int $size, int $position): self
    {
        return new self($size, $position % $size);
    }

    private function __construct(public int $size, public int $position)
    {
    }

    public function rotate(): self
    {
        return self::of($this->size, $this->position + 1);
    }

    public function isAligned(): bool
    {
        return 0 === $this->position;
    }

    public function __toString(): string
    {
        return sprintf('% 2s@% 2s', $this->size, $this->position);
    }
}
