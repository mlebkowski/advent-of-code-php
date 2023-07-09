<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D20;

use App\Aoc\Parser\Matcher;
use App\Aoc\Runner\InputParser;

/** @implements InputParser<ParticleSwarmInput> */
final class ParticleSwarmInputParser implements InputParser
{
    public function parse(string $input): object
    {
        $matcher = Matcher::simple(
            'p=<%d,%d,%d>, v=<%d,%d,%d>, a=<%d,%d,%d>',
            static fn ($px, $py, $pz, $vx, $vy, $vz, $ax, $ay, $az) => Particle::of(
                Vector::of($px, $py, $pz),
                Vector::of($vx, $vy, $vz),
                Vector::of($ax, $ay, $az),
            ),
        );
        return new ParticleSwarmInput($matcher->matchLines($input));
    }
}
