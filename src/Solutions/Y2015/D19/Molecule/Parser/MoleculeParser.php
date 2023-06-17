<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule\Parser;

use App\Solutions\Y2015\D19\Molecule\AtomicPart;
use App\Solutions\Y2015\D19\Molecule\Chemistry;
use App\Solutions\Y2015\D19\Molecule\Compound;
use App\Solutions\Y2015\D19\Molecule\Element;
use App\Solutions\Y2015\D19\Molecule\Foldable;
use App\Solutions\Y2015\D19\Molecule\FoldingInstruction;
use Exception;
use loophp\collection\Collection;

final readonly class MoleculeParser
{
    /** @var Collection<string,Element> */
    private Collection $knownElements;

    /** @var Collection<int,Compound> */
    private Collection $knownCompounds;

    /** @var Collection<int,Compound|Element> */
    private Collection $knownAtoms;

    public static function of(Chemistry $chemistry): self
    {
        return new self($chemistry);
    }

    private function __construct(private Chemistry $chemistry)
    {
        $this->knownElements = Collection::fromIterable($this->chemistry->elements)
            ->sort(
                callback: static function (Element $alpha, Element $bravo) {
                    return strlen($bravo->name) <=> strlen($alpha->name);
                },
            );

        $this->knownCompounds = Collection::fromIterable($this->chemistry->instructions)
            ->map(static fn (FoldingInstruction $instruction) => $instruction->foldable)
            ->filter(static fn (Foldable $foldable) => $foldable instanceof Compound)
            ->sort(
                callback: static function (Compound $alpha, Compound $bravo) {
                    return strlen((string)$bravo) <=> strlen((string)$alpha);
                },
            );

        $this->knownAtoms = $this->knownCompounds->merge($this->knownElements);
    }

    public function build(string $molecule): Token
    {
        // normalize:
        $molecule = strtr($molecule, ['Rn' => '(', 'Y' => ',', 'Ar' => ')']);

        $parenthesis = ParenthesisMatcher::match($molecule);
        if ($parenthesis) {
            $molecule = substr($molecule, $parenthesis->length);
            $branch = Branch::of(
                $this->build($parenthesis->leftPart),
                ...
                Collection::fromIterable($parenthesis->arguments)
                    ->map(fn (string $part) => $this->build($part))
                    ->all(),
            );

            if (!$molecule) {
                return $branch;
            }

            return Pair::of($branch, $this->build($molecule));
        }

        $atom = $this->matchAtom($molecule);
        if ($atom) {
            $molecule = substr($molecule, strlen((string)$atom));
            if (!$molecule) {
                return $atom;
            }
            return Pair::of($atom, $this->build($molecule));
        }

        throw new Exception("Nothing matches: $molecule");
    }

    private function matchAtom($molecule): Compound|Element|null
    {
        return $this->knownAtoms->find(
            callbacks: static fn (AtomicPart $atom) => str_starts_with($molecule, (string)$atom),
        );
    }
}
