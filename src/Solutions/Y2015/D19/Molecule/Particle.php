<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule;

final readonly class Particle implements Foldable, AtomicPart
{
    public static function of(Element $main, Element ...$elements): self
    {
        return new self($main, $elements);
    }

    private function __construct(private Element $main, public array $elements)
    {
        assert(in_array(count($elements), [1, 2, 3], true));
    }

    public function equals(Foldable $other): bool
    {
        return $other instanceof self && (string)$other === (string)$this;
    }

    public function __toString(): string
    {
        return "{$this->main}(" . implode(',', $this->elements) . ")";
    }
}
