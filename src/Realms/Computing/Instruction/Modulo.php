<?php
declare(strict_types=1);

namespace App\Realms\Computing\Instruction;

use App\Realms\Computing\Processor\Processor;
use App\Realms\Computing\Processor\Register;

final readonly class Modulo implements Instruction
{
    public static function of(Register $target, Register|int $value): self
    {
        return new self($target, $value);
    }

    private function __construct(private Register $target, private Register|int $value)
    {
    }

    public function apply(Processor $processor): void
    {
        $processor->setRegister(
            $this->target,
            $processor->readRegister($this->target) % $processor->readValue($this->value),
        );
    }

    public function __toString(): string
    {
        $value = $this->value?->value ?? $this->value;
        $register = $this->target->value;
        return "mod $register $value";
    }
}
