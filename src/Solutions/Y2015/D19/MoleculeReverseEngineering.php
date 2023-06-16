<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19;

use App\Aoc\Progress;
use loophp\collection\Collection;

final class MoleculeReverseEngineering
{
    private int $shortestProcedure = PHP_INT_MAX;
    private array $seen = [];

    public static function ofMolecule(NuclearMedicineInput $input, Progress $progress): iterable
    {
        yield from self::prepare($progress, $input->replacements)
            ->discover(Procedure::ofMolecule($input->molecule));
    }

    private function __construct(
        private readonly Progress $progress,
        private readonly array $replacements,
    ) {
    }

    private static function prepare(Progress $progress, array $replacements): self
    {
        return new self($progress, $replacements);
    }

    private function discover(Procedure $procedure): iterable
    {
        $stepsCount = $procedure->stepsCount();
        $molecule = $procedure->molecule;

        if (array_key_exists($molecule, $this->seen) || $stepsCount >= $this->shortestProcedure) {
            return;
        }
        $this->seen[$molecule] = true;

        if ($procedure->isFolded()) {
            $this->shortestProcedure = min($this->shortestProcedure, $stepsCount);
            yield $procedure;
            return;
        }

        $factory = MoleculeReplacementFactory::of($molecule);

        yield from Collection::fromIterable($this->replacements)
            ->sort()
            ->flatMap(static fn (Replacement $replacement) => $factory->fold($replacement))
            ->apply($this->progress->step(...))
            ->apply(fn (string $molecule) => $this->progress->report('.'))
            ->flatMap(fn (string $molecule) => $this->discover($procedure->step($molecule)));
    }
}
