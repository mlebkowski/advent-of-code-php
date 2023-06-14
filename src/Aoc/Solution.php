<?php

declare(strict_types=1);

namespace App\Aoc;

interface Solution
{
    /** @return Challenge[] */
    public function challenges(): iterable;

    public function solve(Challenge $challenge, string $input): mixed;
}
