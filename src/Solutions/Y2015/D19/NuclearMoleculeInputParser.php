<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19;

use App\Aoc\Runner\InputParser;
use loophp\collection\Collection;

/** @implements InputParser<NuclearMedicineInput> */
final class NuclearMoleculeInputParser implements InputParser
{
    public function parse(string $input): object
    {
        [$replacements, $molecule] = explode("\n\n", $input);
        return NuclearMedicineInput::of(
            trim($molecule),
            ...
            Collection::fromString($replacements)
                ->lines()
                ->map(static fn (string $line) => Replacement::of(...explode(" => ", $line)))
                ->all(),
        );
    }
}
