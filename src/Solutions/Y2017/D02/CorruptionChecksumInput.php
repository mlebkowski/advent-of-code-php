<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D02;

final readonly class CorruptionChecksumInput
{
    public function __construct(public array $rows)
    {
    }
}
