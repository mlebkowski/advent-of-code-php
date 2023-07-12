<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D20;

use App\Aoc\Parser\Matcher;
use App\Aoc\Runner\InputParser;
use App\Realms\Physics\Vector;

/** @implements InputParser<ParticleSwarmInput> */
final class ParticleSwarmInputParser implements InputParser
{
    public function parse(string $input): object
    {
        $matcher = Matcher::simple(
            'p=<%d,%d,%d>, v=<%d,%d,%d>, a=<%d,%d,%d>',
            static fn ($px, $py, $pz, $vx, $vy, $vz, $ax, $ay, $az) => Particle::of(
                Vector::of2d($px, $py, $pz),
                Vector::of2d($vx, $vy, $vz),
                Vector::of2d($ax, $ay, $az),
            ),
        );
        return new ParticleSwarmInput($matcher->matchLines($input));
    }
}
