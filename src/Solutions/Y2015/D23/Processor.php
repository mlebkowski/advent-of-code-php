<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D23;

use App\Aoc\Progress\Progress;
use App\Solutions\Y2015\D23\Instruction\Instruction;
use App\Solutions\Y2015\D23\Instruction\Register;

final class Processor
{
    private int $a = 0;
    private int $b = 0;
    private int $cursor = 0;

    public function __construct(private readonly Progress $progress)
    {
    }

    public function readRegister(Register $register): int
    {
        return match ($register) {
            Register::A => $this->a,
            Register::B => $this->b,
        };
    }

    public function setRegister(Register $register, int $value): void
    {
        match ($register) {
            Register::A => $this->a = $value,
            Register::B => $this->b = $value,
        };
    }

    public function jump(int $jump): void
    {
        $this->cursor += $jump - 1; // -1, because it already advanced to the next instruction
    }

    public function run(Instruction ...$instructions): void
    {
        $instructions = array_values($instructions);

        while ($this->cursor < count($instructions)) {
            $this->progress->step();
            $this->progress->report(
                sprintf(
                    '%d %s [a: %d, b: %d]',
                    $this->cursor,
                    $instructions[$this->cursor],
                    $this->a,
                    $this->b,
                ),
            );
            $instruction = $instructions[$this->cursor++];

            $instruction->apply($this);
        }
    }
}
