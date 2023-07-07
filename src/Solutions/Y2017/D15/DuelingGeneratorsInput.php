<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D15;

final readonly class DuelingGeneratorsInput
{
    public function __construct(/** @var Generator[] */ public array $generators)
    {
    }
}
