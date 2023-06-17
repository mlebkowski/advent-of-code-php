<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule;

final readonly class Particle implements Foldable, AtomicPart
{
    public static function of(Element $main, Element ...$secondary): self
    {
        return new self($main, $secondary);
    }

    private function __construct(private Element $main, private array $secondary)
    {
        assert(in_array(count($secondary), [1, 2, 3], true));
    }

    public function equals(Foldable $other): bool
    {
        return $other instanceof self && (string)$other === (string)$this;
    }

    public function __toString(): string
    {
        return "{$this->main}(" . implode(',', $this->secondary) . ")";
    }
}
