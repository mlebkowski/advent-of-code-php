<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D09;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Solutions\Y2017\D09\Parser\StreamParser;

/**
 * @implements Solution<StreamProcessingInput>
 * @see file://var/2017-9.txt
 * @see file://var/2017-9-1-sample.txt
 * @see file://var/2017-9-1-expected.txt
 * @see file://var/2017-9-2-sample.txt
 * @see file://var/2017-9-2-expected.txt
 */
final class StreamProcessing implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2017, 9);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $group = StreamParser::parse($input->stream);
        return $group->score();
    }
}
