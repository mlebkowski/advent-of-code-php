<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D21;

use App\Solutions\Y2016\D21\Operations\Operation;

final readonly class ScrambledLettersAndHashInput
{
    public function __construct(/** @var Operation[] */ public array $operations)
    {
    }
}
