<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D21;

final readonly class RolePlayingGameSimulatorInput
{
    public function __construct(public int $hitPoints, public int $damage, public int $armor)
    {
    }
}
