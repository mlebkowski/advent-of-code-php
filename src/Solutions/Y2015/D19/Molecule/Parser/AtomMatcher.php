<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule\Parser;

use App\Solutions\Y2015\D19\Molecule\AtomicPart;
use App\Solutions\Y2015\D19\Molecule\Chemistry;
use App\Solutions\Y2015\D19\Molecule\Compound;
use App\Solutions\Y2015\D19\Molecule\Element;
use App\Solutions\Y2015\D19\Molecule\Foldable;
use App\Solutions\Y2015\D19\Molecule\FoldingInstruction;
use loophp\collection\Collection;

final readonly class AtomMatcher
{
    /** @var Collection<int,Compound|Element> */
    private Collection $knownAtoms;

    public function __construct(Chemistry $chemistry)
    {
        $knownElements = Collection::fromIterable($chemistry->elements)
            ->sort(
                callback: static function (Element $alpha, Element $bravo) {
                    return strlen($bravo->name) <=> strlen($alpha->name);
                },
            );

        $knownCompounds = Collection::fromIterable($chemistry->instructions)
            ->map(static fn (FoldingInstruction $instruction) => $instruction->foldable)
            ->filter(static fn (Foldable $foldable) => $foldable instanceof Compound)
            ->sort(
                callback: static function (Compound $alpha, Compound $bravo) {
                    return strlen((string)$bravo) <=> strlen((string)$alpha);
                },
            );

        $this->knownAtoms = $knownCompounds->merge($knownElements);
    }

    /** @return Element[]|Compound[] */
    public function match(string $molecule): array
    {
        return $this->knownAtoms
            ->filter(
                static fn (AtomicPart $atom) => str_starts_with($molecule, (string)$atom),
            )
            ->all();
    }
}
