<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule;

use Exception;
use loophp\collection\Collection;

final class Branch
{
    public static function of(
        Branch|Pair|Particle|Compound|Element $main,
        Branch|Pair|Particle|Compound|Element ...$secondary,
    ): self {
        return new self($main, $secondary);
    }

    private function __construct(
        private Branch|Pair|Particle|Compound|Element $main,
        private array $secondary,
    ) {
    }

    public function intoParticle(FoldingProcess $foldingProcess): Particle
    {
        $main = $this->main;
        if (false === $main instanceof Element) {
            $main = $foldingProcess->fold($main);
        }

        $secondary = Collection::fromIterable($this->secondary)
            ->map(
                static fn ($secondary) => $secondary instanceof Element
                    ? $secondary
                    : $foldingProcess->fold($secondary),
            );

        if ($main instanceof Protomolecule) {
            // todo: check if secondary folded into protomo
            throw new Exception('Todo');
        }

        return Particle::of($main, ...$secondary);
    }

    public function __toString(): string
    {
        $secondary = implode(', ', $this->secondary);
        return "({$this->main}, $secondary)";
    }
}
