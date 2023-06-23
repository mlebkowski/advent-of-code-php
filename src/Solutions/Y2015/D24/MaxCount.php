<?php
declare(strict_types=1);

namespace App\Solutions\Y2015\D24;

final class MaxCount
{
    public static function infinite(): self
    {
        return new self(PHP_INT_MAX);
    }

    public function __construct(private int $count)
    {
    }

    public function update(int $count): void
    {
        $this->count = min($count, $this->count);
    }

    public function exceeded(int $depth): bool
    {
        return $this->count < $depth;
    }
}
