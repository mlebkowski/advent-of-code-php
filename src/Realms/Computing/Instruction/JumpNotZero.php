<?php

declare(strict_types=1);

namespace App\Realms\Computing\Instruction;

use App\Realms\Computing\Processor\Processor;
use App\Realms\Computing\Processor\Register;

final readonly class JumpNotZero implements Instruction
{
    public static function of(Register|int $value, int $offset): self
    {
        return new self($value, $offset);
    }

    private function __construct(public Register|int $value, public int $offset)
    {
    }

    public function apply(Processor $processor): void
    {
        $value = $this->value instanceof Register ? $processor->readRegister($this->value) : $this->value;
        if ($value !== 0) {
            $processor->jump($this->offset);
        }
    }

    public function __toString(): string
    {
        $sign = $this->offset >= 0 ? '+' : '-';
        $offset = abs($this->offset);
        $register = $this->value?->value ?? $this->value;
        return "jnz $register $sign$offset";
    }
}
