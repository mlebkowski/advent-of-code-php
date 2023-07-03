<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D03\Builder;

use App\Realms\Cartography\Point;

final class SequentialValueFactory implements ValueFactory
{
    public function forPoint(Point $point, int $n, array $spiral): int
    {
        return $n;
    }
}
