<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D05;

use App\Realms\Computing\Instruction\Instruction;
use App\Realms\Computing\Processor\Processor;

final readonly class LittleStrangeJump implements Instruction
{
    public static function of(int $offset): self
    {
        return new self($offset);
    }

    private function __construct(private int $offset)
    {
    }

    public function apply(Processor $processor): void
    {
        $processor->updateInstruction($processor->cursor() - 1, self::of($this->offset + 1));
        $processor->jump($this->offset);
    }

    public function __toString(): string
    {
        return "lsj $this->offset";
    }
}
