<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D10;

final readonly class KnotHashInput
{
    public function __construct(public array $asIntegers, public string $input)
    {
    }
}
