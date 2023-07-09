<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D19;

use App\Realms\Cartography\Map;

final readonly class ASeriesOfTubesInput
{
    public function __construct(public Map $map)
    {
    }
}
