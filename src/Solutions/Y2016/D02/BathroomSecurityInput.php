<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D02;

use App\Solutions\Y2016\D02\Move\Move;

final readonly class BathroomSecurityInput
{
    public function __construct(/** @var Move[] */ public array $moves)
    {
    }
}
