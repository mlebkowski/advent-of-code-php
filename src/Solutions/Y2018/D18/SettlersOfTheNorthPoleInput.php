<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D18;

use App\Realms\Cartography\Map;

final readonly class SettlersOfTheNorthPoleInput
{
    public function __construct(public Map $map)
    {
    }
}
