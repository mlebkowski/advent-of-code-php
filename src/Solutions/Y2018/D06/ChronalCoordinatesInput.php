<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D06;

use App\Realms\Cartography\Point;

final readonly class ChronalCoordinatesInput
{
    public function __construct(/** @var Point[] */ public array $coordinates)
    {
    }
}
