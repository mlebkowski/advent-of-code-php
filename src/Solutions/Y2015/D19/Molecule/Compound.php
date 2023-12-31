<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule;

final readonly class Compound implements Foldable, AtomicPart
{
    public static function of(Element $alpha, Element $bravo): self
    {
        return new self($alpha, $bravo);
    }

    private function __construct(public Element $alpha, public Element $bravo)
    {
    }

    public function equals(Foldable $other): bool
    {
        return $other instanceof self && (string)$other === (string)$this;
    }

    public function __toString(): string
    {
        return "{$this->alpha}{$this->bravo}";
    }
}
