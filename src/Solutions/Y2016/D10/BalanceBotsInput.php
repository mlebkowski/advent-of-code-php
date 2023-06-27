<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D10;

final readonly class BalanceBotsInput
{
    public function __construct(
        /** @var InitialDisposition[] */
        public array $values,
        /** @var Rule[] */
        public array $rules,
    ) {
    }
}
