<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D09;

final readonly class MarbleManiaInput
{
    public function __construct(public int $players, public int $points)
    {
    }
}
