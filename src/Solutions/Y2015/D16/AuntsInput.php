<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D16;

final readonly class AuntsInput
{
    /** @var Sue[] $aunts */
    public array $aunts;
    
    public function __construct(array $aunts)
    {
        $this->aunts = $aunts;
    }
}
