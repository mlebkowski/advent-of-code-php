<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D22;

use App\Realms\Cartography\Point;

final class Node
{
    public static function of(int $x, int $y, int $size, int $used): self
    {
        return new self(Point::of($x, $y), $size, $used);
    }

    private function __construct(Point $point, int $size, int $used)
    {
        assert($size >= $used && $used >= 0);
    }
}
