<?php

declare(strict_types=1);

function factorial(int $n): float
{
    return $n > 1 ? $n * factorial($n - 1) : 1;
}

function binomialCoefficient(int $n, int $k): int
{
    return (int)(factorial($n) / (factorial($k) * factorial($n - $k)));
}
