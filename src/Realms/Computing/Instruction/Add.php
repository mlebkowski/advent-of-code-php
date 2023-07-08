<?php
declare(strict_types=1);

namespace App\Realms\Computing\Instruction;

use App\Realms\Computing\Processor\Processor;
use App\Realms\Computing\Processor\Register;

final readonly class Add implements Instruction
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
        $targetValue = $processor->readRegister($this->target);
        $value = $processor->readValue($this->value) + $targetValue;
        $processor->setRegister($this->target, $value);
    }

    public function __toString(): string
    {
        $value = $this->value?->value ?? $this->value;
        $register = $this->target->value;
        return "add $register $value";
    }
}
