<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D18;

final class LightMatrixInput
{
    public readonly LightMatrix $matrix;

    public function __construct(bool ...$lights)
    {
        $this->matrix = LightMatrix::ofLights(...$lights);
    }
}
