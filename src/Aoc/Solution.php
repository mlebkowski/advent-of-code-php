<?php

declare(strict_types=1);

namespace App\Aoc;

use App\Aoc\Runner\RunMode;

/**
 * @template Input
 */
interface Solution
{
    /** @return Challenge[] */
    public function challenges(): iterable;

    /**
     * @param Input $input
     */
    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed;
}
