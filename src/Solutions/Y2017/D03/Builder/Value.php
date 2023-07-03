<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D03\Builder;

use App\Realms\Cartography\Point;

final readonly class Value
{
    public static function of(Point $point, int $value): self
    {
        return new self($point, $value);
    }

    private function __construct(public Point $point, public int $value)
    {
    }

}
