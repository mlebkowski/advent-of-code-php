<?php
declare(strict_types=1);

namespace App\Realms\Computing\Instruction;

use App\Realms\Computing\Processor\Processor;

final readonly class Breakpoint implements Instruction
{
    public static function of(Instruction $instruction): self
    {
        return new self($instruction);
    }

    private function __construct(private Instruction $instruction)
    {
    }

    public function apply(Processor $processor): void
    {
        $this->instruction->apply($processor);
    }

    public function __toString(): string
    {
        return sprintf('• %s', $this->instruction);
    }
}
