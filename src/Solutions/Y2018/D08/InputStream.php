<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D08;

final class InputStream
{
    public static function of(array $numbers): self
    {
        return new self($numbers);
    }

    private function __construct(private array $numbers)
    {
    }

    public function next(): int
    {
        return array_shift($this->numbers);
    }
}
