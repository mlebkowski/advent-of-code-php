<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D09;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;

/** @implements Solution<ExplosivesInCyberspaceInput> */
final class ExplosivesInCyberspace implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2016, 9);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $version = $challenge->isPartOne() ? Format::V1 : Format::V2;
        return Decompressor::getDecompressedLength($input->input, $version);
    }
}
