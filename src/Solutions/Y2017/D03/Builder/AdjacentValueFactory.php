<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D03\Builder;

use App\Realms\Cartography\Point;
use loophp\collection\Collection;

final class AdjacentValueFactory implements ValueFactory
{
    public function forPoint(Point $point, int $n, array $spiral): int
    {
        return Collection::fromIterable($point->adjacent())
            ->map(static fn (Point $point) => $spiral[(string)$point] ?? 0)
            ->reduce(static fn (int $sum, int $value) => $sum + $value, 0);
    }
}
