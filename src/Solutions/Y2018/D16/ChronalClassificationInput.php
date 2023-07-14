<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D16;

final readonly class ChronalClassificationInput
{
    public function __construct(
        /** @var Observation[] */
        public array $observations,
        /** @var InstructionCall[] */
        public array $calls,
    ) {
    }
}
