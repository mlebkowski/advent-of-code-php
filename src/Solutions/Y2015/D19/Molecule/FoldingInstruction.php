<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule;

use Stringable;

final readonly class FoldingInstruction implements Stringable
{
    public static function of(Element|Protomolecule $into, Compound|Particle $foldable): self
    {
        return new self($into, $foldable);
    }

    private function __construct(public Element|Protomolecule $into, public Compound|Particle $foldable)
    {
    }

    public function handles(Compound|Particle $input): bool
    {
        return $this->foldable->equals($input);
    }

    public function __toString(): string
    {
        return "{$this->into} => {$this->foldable}";
    }
}
