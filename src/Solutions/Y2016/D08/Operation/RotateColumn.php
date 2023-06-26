<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D08\Operation;

use Stringable;

final readonly class RotateColumn implements Stringable
{
    public static function of(int $x, int $offset): self
    {
        return new self($x, $offset);
    }

    private function __construct(public int $x, public int $offset)
    {
        assert($x >= 0);
    }

    public function __toString(): string
    {
        return sprintf('rotate column x=%d by %d', $this->x, $this->offset);
    }
}
