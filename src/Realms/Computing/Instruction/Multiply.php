<?php
declare(strict_types=1);

namespace App\Realms\Computing\Instruction;

use App\Realms\Computing\Processor\Processor;
use App\Realms\Computing\Processor\Register;

final readonly class Multiply implements Instruction
{
    public static function of(Register|int $value, Register $target): self
    {
        return new self($value, $target);
    }

    private function __construct(private Register|int $value, private Register $target)
    {
    }

    public function apply(Processor $processor): void
    {
        $targetValue = $processor->readRegister($this->target);
        $value = $processor->readValue($this->value) * $targetValue;
        $processor->setRegister($this->target, $value);
    }

    public function __toString(): string
    {
        $value = $this->value?->value ?? $this->value;
        $register = $this->target->value;
        return "mul $value $register";
    }
}
