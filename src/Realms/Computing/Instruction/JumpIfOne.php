<?php

declare(strict_types=1);

namespace App\Realms\Computing\Instruction;

use App\Realms\Computing\Processor\Processor;
use App\Realms\Computing\Processor\Register;

final readonly class JumpIfOne implements Instruction
{
    public static function of(Register $register, int $offset): self
    {
        return new self($register, $offset);
    }

    private function __construct(public Register $register, public int $offset)
    {
    }

    public function apply(Processor $processor): void
    {
        $value = $processor->readRegister($this->register);
        if ($value === 1) {
            $processor->jump($this->offset);
        }
    }

    public function __toString(): string
    {
        $sign = $this->offset >= 0 ? '+' : '-';
        $value = abs($this->offset);
        $register = $this->register->value;
        return "jio $register, $sign$value";
    }
}
