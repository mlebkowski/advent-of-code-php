<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule\Parser;

use App\Solutions\Y2015\D19\Molecule\Chemistry;
use App\Solutions\Y2015\D19\Molecule\Compound;
use App\Solutions\Y2015\D19\Molecule\Element;
use App\Solutions\Y2015\D19\Molecule\Problems\NothingMatchesMolecule;
use loophp\collection\Collection;

final readonly class MoleculeParser
{
    private AtomMatcher $atomMatcher;

    public static function of(Chemistry $chemistry): self
    {
        return new self($chemistry);
    }

    private function __construct(Chemistry $chemistry)
    {
        $this->atomMatcher = new AtomMatcher($chemistry);
    }

    /**
     * @throws NothingMatchesMolecule
     */
    public function build(string $molecule): Token
    {
        // normalize:
        $molecule = strtr($molecule, ['Rn' => '(', 'Y' => ',', 'Ar' => ')']);

        $parenthesis = ParenthesisMatcher::match($molecule);
        if ($parenthesis) {
            $complex = Complex::of(
                $this->build($parenthesis->leftPart),
                ...
                Collection::fromIterable($parenthesis->arguments)
                    ->map(fn (string $part) => $this->build($part))
                    ->all(),
            );

            return Pair::autoCollapse(
                $complex,
                $this->tryBuild(substr($molecule, $parenthesis->length)),
            );
        }

        $atoms = $this->atomMatcher->match($molecule);

        NothingMatchesMolecule::whenever(0 === count($atoms), $molecule);

        return Branch::autoCollapse(
            ...
            Collection::fromIterable($atoms)
                ->map(
                    fn (Element|Compound $atom) => Pair::autoCollapse(
                        $atom,
                        $this->tryBuild(substr($molecule, strlen((string)$atom))),
                    ),
                )
                ->all(),
        );
    }

    /**
     * @throws NothingMatchesMolecule
     */
    private function tryBuild(?string $molecule): Token|null
    {
        if (!$molecule) {
            return null;
        }

        return $this->build($molecule);
    }
}
