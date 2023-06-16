<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19;

use App\Aoc\Challenge;
use App\Aoc\Part;
use App\Aoc\Progress;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use loophp\collection\Collection;

/** @implements Solution<NuclearMedicineInput> */
final class MedicineForRudolph implements Solution
{
    public function challenges(): iterable
    {
        yield Challenge::of(2015, 19, Part::Two);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $progress = Progress::unknown();
        $reverseEngineering = MoleculeReverseEngineering::ofMolecule(
            $input->molecule,
            $progress,
            ...$input->replacements,
        );
        return Collection::fromIterable($reverseEngineering)
            ->reduce(
                static fn (MinimumStepsStrategy $min, Procedure $process) => $min->apply($process),
                MinimumStepsStrategy::empty(),
            )
            ->steps();
    }
}
