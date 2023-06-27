<?php

declare(strict_types=1);

namespace App\Realms\Computing\Instruction;

use App\Realms\Computing\Processor\Processor;
use App\Realms\Computing\Processor\Register;

final readonly class Triple implements Instruction
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
        $processor->setRegister($this->register, $value * 3);
    }

    public function __toString()
    {
        $register = $this->register->value;
        return "tpl $register";
    }
}
