<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule\Parser;

use App\Solutions\Y2015\D19\Molecule\Compound;
use App\Solutions\Y2015\D19\Molecule\Element;
use App\Solutions\Y2015\D19\Molecule\Foldable;
use App\Solutions\Y2015\D19\Molecule\FoldingProcess;
use App\Solutions\Y2015\D19\Molecule\Protomolecule;
use Exception;
use Stringable;

final readonly class Pair implements Group, Stringable
{
    public static function of(Token $alpha, Token $bravo): self
    {
        return new self($alpha, $bravo);
    }

    private function __construct(private Token $alpha, private Token $bravo)
    {
    }

    public function intoFoldable(FoldingProcess $foldingProcess): Foldable
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
