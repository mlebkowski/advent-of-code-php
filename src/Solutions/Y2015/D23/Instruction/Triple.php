<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D23\Instruction;

use App\Solutions\Y2015\D23\Processor;

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