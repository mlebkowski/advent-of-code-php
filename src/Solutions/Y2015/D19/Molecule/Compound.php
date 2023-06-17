<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule;

final readonly class Compound implements AtomicPart
{
    public static function of(Element $alpha, Element $bravo): self
    {
        return new self($alpha, $bravo);
    }

    private function __construct(private Element $alpha, private Element $bravo)
    {
    }

    public function equals(Compound|Particle $other): bool
    {
        return $other instanceof self && (string)$other === (string)$this;
    }

    public function __toString(): string
    {
        return "{$this->alpha}{$this->bravo}";
    }
}
