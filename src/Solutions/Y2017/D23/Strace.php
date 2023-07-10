<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D23;

use App\Realms\Computing\Instruction\Instruction;
use App\Realms\Computing\Processor\Processor;

final readonly class Strace implements Instruction
{
    public static function of(Instruction $other): self
    {
        return new self($other);
    }

    private function __construct(private Instruction $other)
    {
    }

    public function apply(Processor $processor): void
    {
        $processor->getOutputDevice()->write((string)$this->other);
        $this->other->apply($processor);
    }

    public function __toString(): string
    {
        return "strace $this->other";
    }
}
