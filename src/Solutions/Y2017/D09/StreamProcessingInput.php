<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D09;

final readonly class StreamProcessingInput
{
    public function __construct(public string $stream)
    {
    }
}
