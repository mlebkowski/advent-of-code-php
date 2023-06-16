<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19;

use Stringable;

final readonly class Procedure implements Stringable
{
    private const ProtoMolecule = 'e';

    public static function ofMolecule(string $molecule): self
    {
        return new self($molecule, []);
    }

    private function __construct(public string $molecule, private array $steps)
    {
    }

    public function isFolded(): bool
    {
        return self::ProtoMolecule === $this->molecule;
    }

    public function stepsCount(): int
    {
        return sizeof($this->steps);
    }

    public function step(string $molecule): self
    {
        return new self($molecule, [$this->molecule, ...$this->steps]);
    }

    public function __toString(): string
    {
        return implode(' → ', [$this->molecule, ...$this->steps]);
    }
}
