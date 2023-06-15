<?php

declare(strict_types=1);

namespace App\Aoc\Runner;

/**
 * @template T
 */
interface InputParser
{
    /** @return T */
    public function parse(string $input): object;
}
