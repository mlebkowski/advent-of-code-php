<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D23\Instruction;

use App\Solutions\Y2015\D23\Processor;

final readonly class JumpIfEven implements Instruction
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
        if ($value % 2 === 0) {
            $processor->jump($this->offset);
        }
    }

    public function __toString(): string
    {
        $sign = $this->offset >= 0 ? '+' : '-';
        $value = abs($this->offset);
        $register = $this->register->value;
        return "jie $register, $sign$value";
    }
}
