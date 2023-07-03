<?php

declare(strict_types=1);

namespace App\Realms\Computing\Processor;

use App\Aoc\Progress\Progress;
use App\Realms\Computing\Instruction\Instruction;

final class Processor
{
    private array $registers = [];
    private int $cursor = 0;

    public static function ofInstructions(Instruction ...$instructions): self
    {
        return new self($instructions);
    }

    public static function of(Progress $progress, Instruction ...$instructions): self
    {
        return new self(array_values($instructions), $progress);
    }

    public function __construct(
        /** @var Instruction[] */
        private array $instructions,
        private readonly ?Progress $progress = null,
    ) {
        foreach (Register::cases() as $register) {
            $this->setRegister($register, 0);
        }
    }

    public function readValue(Register|int $value): int
    {
        if ($value instanceof Register) {
            return $this->readRegister($value);
        }
        return $value;
    }

    public function readRegister(Register $register): int
    {
        return $this->registers[$register->value];
    }

    public function setRegister(Register $register, int $value): void
    {
        $this->registers[$register->value] = $value;
    }

    public function readInstruction(int $offset): ?Instruction
    {
        return $this->instructions[$offset] ?? null;
    }

    public function updateInstruction(int $offset, Instruction $instruction): void
    {
        $this->instructions[$offset] = $instruction;
    }

    public function cursor(): int
    {
        return $this->cursor;
    }

    public function jump(int $jump): void
    {
        $this->cursor += $jump - 1; // -1, because it already advanced to the next instruction
    }

    public function run(): void
    {
        while ($this->cursor < count($this->instructions)) {
            $this->progress?->iterate($this->stateAsString(...));
            $instruction = $this->instructions[$this->cursor++];

            $instruction->apply($this);
        }
    }

    private function stateAsString(): string
    {
        $registers = array_map(
            static fn (int $value, string $key) => "$key: $value",
            $this->registers,
            array_keys($this->registers),
        );

        return sprintf(
            '%d %s [%s]',
            $this->cursor,
            $this->instructions[$this->cursor],
            implode(', ', $registers),
        );
    }
}
