<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19;

use App\Aoc\Challenge;
use App\Aoc\Part;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use loophp\collection\Collection;

/** @implements Solution<NuclearMedicineInput> */
final class MolecularMachineCalibration implements Solution
{
    public function challenges(): iterable
    {
        yield Challenge::of(2015, 19, Part::One);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $factory = MoleculeReplacementFactory::of($input->molecule);
        return Collection::fromIterable($input->replacements)
            ->flatMap($factory->generateReplacements(...))
            ->distinct()
            ->count();
    }
}
