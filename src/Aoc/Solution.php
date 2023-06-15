<?php

declare(strict_types=1);

namespace App\Aoc;

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
    public function solve(Challenge $challenge, mixed $input): mixed;
}
