<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D03;

use App\Realms\Cartography\Area;

final readonly class Claim
{
    public static function of(int $id, Area $area): self
    {
        return new self($id, $area);
    }

    private function __construct(public int $id, public Area $area)
    {
    }
}
