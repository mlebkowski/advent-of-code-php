<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D21;

use App\Aoc\Runner\InputParser;

/** @implements InputParser<RolePlayingGameSimulatorInput> */
final class RolePlayingGameSimulatorInputParser implements InputParser
{
    public function parse(string $input): object
    {
        preg_match(
            '/
                Hit\ Points: \s (?P<hp>\d+) \s*
                Damage: \s (?P<damage>\d+) \s*
                Armor: \s (?P<armor>\d+) \s*
            /x',
            $input,
            $matches,
        );
        return new RolePlayingGameSimulatorInput(
            (int)$matches['hp'],
            (int)$matches['damage'],
            (int)$matches['armor'],
        );
    }
}
