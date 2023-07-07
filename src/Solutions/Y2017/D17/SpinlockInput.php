<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D17;

final readonly class SpinlockInput
{
    public function __construct(public int $step)
    {
    }
}
