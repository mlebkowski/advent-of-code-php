<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D10;

use App\Realms\Cartography\Map;

final readonly class Result
{
    public static function of(Map $photo, int $seconds): self
    {
        return new self($photo, $seconds);
    }

    private function __construct(public Map $photo, public int $seconds)
    {
    }
}
