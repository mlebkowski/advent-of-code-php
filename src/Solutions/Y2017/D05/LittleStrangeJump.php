<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D05;

use App\Realms\Computing\Instruction\Instruction;
use App\Realms\Computing\Processor\Processor;

final readonly class LittleStrangeJump implements Instruction
{
    public static function of(int $offset): self
    {
        return new self($offset, PHP_INT_MAX);
    }

    public static function withCap(int $offset): self
    {
        return new self($offset, 3);
    }

    private function __construct(private int $offset, private int $cap)
    {
    }

    public function apply(Processor $processor): void
    {
        $offset = $this->offset + ($this->offset >= $this->cap ? -1 : +1);
        $instruction = new self($offset, $this->cap);
        $processor->updateInstruction($processor->cursor() - 1, $instruction);
        $processor->jump($this->offset);
    }

    public function __toString(): string
    {
        return "lsj $this->offset";
    }
}
