<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D07;

use Stringable;

final readonly class Program implements Stringable
{
    public static function of(string $name, int $weight): self
    {
        return new self($name, $weight);
    }

    private function __construct(public string $name, private int $weight)
    {
    }

    public function weight(): int
    {
        return $this->weight;
    }

    public function toTree(): array
    {
        return [$this->name];
    }

    public function __toString(): string
    {
        return "$this->name ($this->weight)";
    }
}
