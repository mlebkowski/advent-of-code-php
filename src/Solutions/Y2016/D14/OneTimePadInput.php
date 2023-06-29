<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D14;

final readonly class OneTimePadInput
{
    public function __construct(public string $salt)
    {
    }
}
