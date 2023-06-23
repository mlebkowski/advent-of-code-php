<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D23\Instruction;

use App\Solutions\Y2015\D23\Processor;

final readonly class Jump implements Instruction
{
    public static function of(int $offset): self
    {
        return new self($offset);
    }

    private function __construct(public int $offset)
    {
    }

    public function apply(Processor $processor): void
    {
        $processor->jump($this->offset);
    }

    public function __toString(): string
    {
        $sign = $this->offset >= 0 ? '+' : '-';
        $value = abs($this->offset);
        return "jmp $sign$value";
    }
}
