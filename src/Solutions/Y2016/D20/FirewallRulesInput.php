<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D20;

final readonly class FirewallRulesInput
{
    public function __construct(/** @var Range[] */ public array $ranges)
    {
    }
}
