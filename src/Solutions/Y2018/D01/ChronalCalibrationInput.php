<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D01;

final readonly class ChronalCalibrationInput
{
    public function __construct(public array $frequencyChanges)
    {
    }
}
