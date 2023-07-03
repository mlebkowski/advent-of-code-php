<?php
declare(strict_types=1);

namespace App\Realms\Computing\Instruction;

use App\Realms\Computing\Processor\Processor;

final readonly class Noop implements Instruction
{
    public static function instruction(): self
    {
        return new self();
    }

    private function __construct()
    {
    }

    public function apply(Processor $processor): void
    {
        // noop
    }

    public function __toString(): string
    {
        return 'noop';
    }
}
