<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D07;

use Stringable;

final readonly class ByteAllocationBlock implements Stringable
{
    public static function of(string $outer, string $inner): self
    {
        return new self($outer, $inner);
    }

    private function __construct(private string $outer, private string $inner)
    {
        assert(strlen($this->outer) === 1);
        assert(strlen($this->inner) === 1);
    }

    public function __toString(): string
    {
        return $this->outer . $this->inner . $this->outer;
    }
}
