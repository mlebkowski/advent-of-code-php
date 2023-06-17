<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule;

use Exception;
use Stringable;

final readonly class Pair implements Stringable
{
    // todo: branch!
    public static function of(
        Pair|Particle|Compound|Element|Branch $alpha,
        Pair|Particle|Compound|Element|Branch $bravo,
    ): self {
        return new self($alpha, $bravo);
    }

    private function __construct(
        private Pair|Particle|Compound|Element|Branch $alpha,
        private Pair|Particle|Compound|Element|Branch $bravo,
    ) {
    }

    public function intoCompound(FoldingProcess $foldingProcess): Compound
    {
        $alpha = $this->alpha;
        if (false === $alpha instanceof Element) {
            $alpha = $foldingProcess->fold($alpha);
        }
        $bravo = $this->bravo;
        if (false === $bravo instanceof Element) {
            $bravo = $foldingProcess->fold($bravo);
        }

        if ($alpha instanceof Protomolecule || $bravo instanceof Protomolecule) {
            // it folds all back to the protomolecule
            throw new Exception('Todo');
        }

        return Compound::of($alpha, $bravo);
    }

    public function __toString(): string
    {
        return "[$this->alpha, $this->bravo]";
    }
}
