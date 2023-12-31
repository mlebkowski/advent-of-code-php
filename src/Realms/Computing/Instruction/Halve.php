<?php

declare(strict_types=1);

namespace App\Realms\Computing\Instruction;

use App\Realms\Computing\Processor\Processor;
use App\Realms\Computing\Processor\Register;
use RuntimeException;

final readonly class Halve implements Instruction
{
    public static function of(Register $register): self
    {
        return new self($register);
    }

    private function __construct(public Register $register)
    {
    }

    public function apply(Processor $processor): void
    {
        $value = $processor->readRegister($this->register);
        if ($value % 2 !== 0) {
            throw new RuntimeException("Cannot divide value of $value");
        }
        $processor->setRegister($this->register, (int)($value / 2));
    }

    public function __toString(): string
    {
        $register = $this->register->value;
        return "hlv $register";
    }
}
