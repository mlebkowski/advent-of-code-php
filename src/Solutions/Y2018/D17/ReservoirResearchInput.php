<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D17;

use App\Realms\Cartography\LineSegment;

final readonly class ReservoirResearchInput
{
    public function __construct(/** @var LineSegment[] */ public array $lineSegments)
    {
    }
}
