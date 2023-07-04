<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D08;

final readonly class IHeardYouLikeRegistersInput
{
    public function __construct(/** @var Operation[] */ public array $operations)
    {
    }
}
