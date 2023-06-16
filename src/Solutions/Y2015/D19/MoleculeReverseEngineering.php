<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19;

use App\Aoc\Progress;
use loophp\collection\Collection;

final readonly class MoleculeReverseEngineering
{
    public static function ofMolecule(
        string $molecule,
        Progress $progress,
        Replacement ...$replacements,
    ): iterable {
        yield from self::discover(
            Procedure::ofMolecule($molecule),
            $progress,
            ...$replacements,
        );
    }

    private static function discover(
        Procedure $procedure,
        Progress $progress,
        Replacement ...$replacements,
    ): iterable {
        if ($procedure->isFolded()) {
            yield $procedure;
            return;
        }

        $factory = MoleculeReplacementFactory::of($procedure->molecule);

        yield from Collection::fromIterable($replacements)
            ->flatMap(static fn (Replacement $replacement) => $factory->fold($replacement))
            ->apply($progress->step(...))
            ->apply(static fn (string $molecule) => $progress->report($procedure->stepsCount()))
            ->flatMap(static fn (string $molecule) => self::discover(
                $procedure->step($molecule),
                $progress,
                ...$replacements,
            ));
    }
}
