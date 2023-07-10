<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D25;

final class Cursor
{
    public static function starting(): self
    {
        return new self(0);
    }

    private function __construct(private int $position)
    {
    }

    public function position(): int
    {
        return $this->position;
    }

    public function move(TapeDirection $direction): void
    {
        match ($direction) {
            TapeDirection::Left => --$this->position,
            TapeDirection::Right => ++$this->position,
        };
    }
}
