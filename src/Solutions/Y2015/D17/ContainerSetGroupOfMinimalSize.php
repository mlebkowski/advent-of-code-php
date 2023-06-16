<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D17;

final readonly class ContainerSetGroupOfMinimalSize implements ContainerSetGroup
{
    public static function empty(): self
    {
        return new self(PHP_INT_MAX, 0);
    }

    public static function ofSize(int $size): self
    {
        return new self($size, 1);
    }

    private function __construct(private int $size, private int $count)
    {
    }

    public function count(): int
    {
        return $this->count;
    }

    public function apply(ContainerSet $set): ContainerSetGroup
    {
        return match (true) {
            $set->count < $this->size => self::ofSize($set->count),
            $set->count === $this->size => $this->withIncreasedCount(),
            default => $this,
        };
    }

    private function withIncreasedCount(): self
    {
        return new self($this->size, $this->count + 1);
    }
}
