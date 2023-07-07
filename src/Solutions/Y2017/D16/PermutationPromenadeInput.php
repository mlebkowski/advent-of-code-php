<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D16;

use App\Solutions\Y2017\D16\DanceMoves\DanceMove;

final readonly class PermutationPromenadeInput
{
    public function __construct(/** @var DanceMove[] */ public array $moves)
    {
    }
}
