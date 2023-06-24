<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D05;

final readonly class HowAboutANiceGameOfChessInput
{
    public function __construct(public string $doorId)
    {
        assert(trim($this->doorId) === $this->doorId);
    }
}
