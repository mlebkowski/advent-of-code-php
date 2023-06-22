<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D22;

final class WizardSimulatorInput
{
    public function __construct(public int $hitPoints, public int $damage)
    {
    }

}
