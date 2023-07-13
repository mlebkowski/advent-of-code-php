<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D13\Events;

use App\Realms\Cartography\Point;

final readonly class Crash
{
    public static function of(Point $position): self
    {
        return new self($position);
    }

    private function __construct(public Point $position)
    {
    }
}
