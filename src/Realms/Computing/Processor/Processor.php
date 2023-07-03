<?php

declare(strict_types=1);

namespace App\Realms\Computing\Processor;

use App\Aoc\Progress\Progress;
use App\Realms\Computing\Instruction\Instruction;

final class Processor
{
    private array $registers = [];
    private int $cursor = 0;

    public function __construct(private readonly Progress $progress)
    {
        foreach (Register::cases() as $register) {
            $this->setRegister($register, 0);
        }
    }

    public function readRegister(Register $register): int
    {
        return $this->registers[$register->value];
    }

    public function setRegister(Register $register, int $value): void
    {
        $this->registers[$register->value] = $value;
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
                fn () => sprintf(
                    '%d %s [%s]',
                    $this->cursor,
                    $instructions[$this->cursor],
                    implode(
                        ', ',
                        array_map(
                            static fn (int $value, string $key) => "$key: $value",
                            $this->registers,
                            array_keys($this->registers),
                        ),
                    ),
                ),
            );
            $instruction = $instructions[$this->cursor++];

            $instruction->apply($this);
        }
    }
}
