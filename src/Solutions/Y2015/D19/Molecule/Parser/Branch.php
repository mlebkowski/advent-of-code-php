<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule\Parser;

use App\Solutions\Y2015\D19\Molecule\Element;
use App\Solutions\Y2015\D19\Molecule\Foldable;
use App\Solutions\Y2015\D19\Molecule\FoldingProcess;
use App\Solutions\Y2015\D19\Molecule\Particle;
use App\Solutions\Y2015\D19\Molecule\Protomolecule;
use Exception;
use loophp\collection\Collection;

final class Branch implements Group
{
    public static function of(Token $main, Token ...$secondary): self
    {
        return new self($main, $secondary);
    }

    private function __construct(private Token $main, private array $secondary)
    {
    }

    public function intoFoldable(FoldingProcess $foldingProcess): Foldable
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
