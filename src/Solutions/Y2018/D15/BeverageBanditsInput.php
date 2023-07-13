<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D15;

use App\Realms\Cartography\Map;

final readonly class BeverageBanditsInput
{
    public function __construct(public Map $map)
    {
    }
}
