<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D22;

use App\Realms\Cartography\Map;

final readonly class SporificaVirusInput
{
    public function __construct(public Map $infectionMap)
    {
    }
}
