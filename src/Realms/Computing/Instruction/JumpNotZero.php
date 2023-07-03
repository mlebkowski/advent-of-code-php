<?php

declare(strict_types=1);

namespace App\Realms\Computing\Instruction;

use App\Realms\Computing\Processor\Processor;
use App\Realms\Computing\Processor\Register;

final readonly class JumpNotZero implements Instruction
{
    public static function of(Register|int $value, Register|int $offset): self
    {
        return new self($value, $offset);
    }

    private function __construct(public Register|int $value, public Register|int $offset)
    {
    }

    public function apply(Processor $processor): void
    {
        $value = $processor->readValue($this->value);
        if ($value !== 0) {
            $offset = $processor->readValue($this->offset);
            $processor->jump($offset);
        }
    }

    public function __toString(): string
    {
        if ($this->offset instanceof Register) {
            $offset = $this->offset->value;
        } else {
            $sign = $this->offset >= 0 ? '+' : '-';
            $offset = $sign . abs($this->offset);
        }
        $register = $this->value?->value ?? $this->value;
        return "jnz $register $offset";
    }
}
