<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D10;

final readonly class Rule
{
    public static function of(int $botId, Target $low, Target $high): self
    {
        return new self($botId, $low, $high);
    }

    private function __construct(public int $botId, public Target $low, public Target $high)
    {
    }
}
