<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D06;

final readonly class MemoryReallocationInput
{
    public function __construct(public array $memoryBanks)
    {
    }
}
