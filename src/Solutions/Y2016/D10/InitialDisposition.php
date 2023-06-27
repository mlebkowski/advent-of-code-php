<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D10;

final readonly class InitialDisposition
{
    public static function of(int $botId, int $value): self
    {
        return new self($botId, $value);
    }

    private function __construct(public int $botId, public int $value)
    {
    }
}
