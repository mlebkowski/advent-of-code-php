<?php
declare(strict_types=1);

namespace App\Aoc\Runner;

interface RequiresMemoryLimit
{
    public function getRequiredMemoryLimit(): string;
}
