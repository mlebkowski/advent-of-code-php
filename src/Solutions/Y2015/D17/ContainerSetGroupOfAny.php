<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D17;

final readonly class ContainerSetGroupOfAny implements ContainerSetGroup
{
    public static function empty(): self
    {
        return new self(0);
    }

    public function __construct(private int $count)
    {
    }

    public function count(): int
    {
        return $this->count;
    }

    public function apply(ContainerSet $set): self
    {
        return new self($this->count + 1);
    }
}
