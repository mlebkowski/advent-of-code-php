<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D16;

final readonly class InstructionCall
{
    public static function of(Opcode $opcode, int $alpha, int $bravo, D16Register $target): self
    {
        return new self($opcode, $alpha, $bravo, $target);
    }

    private function __construct(
        public Opcode $opcode,
        public int $alpha,
        public int $bravo,
        public D16Register $target,
    ) {
    }
}
