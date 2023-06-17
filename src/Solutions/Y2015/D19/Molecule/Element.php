<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule;

final readonly class Element implements Parser\Token, BasicElement
{
    public static function of(string $name): self
    {
        return new self($name);
    }

    private function __construct(public string $name)
    {
        assert(strlen($this->name) <= 2);
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
