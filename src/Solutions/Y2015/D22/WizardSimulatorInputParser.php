<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D22;

use App\Aoc\Runner\InputParser;

/** @implements InputParser<WizardSimulatorInput> */
final class WizardSimulatorInputParser implements InputParser
{
    public function parse(string $input): object
    {
        preg_match(
            '/
                Hit\ Points: \s (?P<hp>\d+) \s*
                Damage: \s (?P<damage>\d+) \s*
            /x',
            $input,
            $matches,
        );
        return new WizardSimulatorInput((int)$matches['hp'], (int)$matches['damage']);
    }
}
