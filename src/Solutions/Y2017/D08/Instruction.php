<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D08;

final class Instruction
{
    public static function of(
        string $register,
        Operation $operation,
        int $value,
        string $otherRegister,
        Comparison $comparison,
        int $otherValue,
    ): self {
        $value = $operation->multiplier() * $value;
        return new self($register, $value, $otherRegister, $comparison, $otherValue);
    }

    private function __construct(
        private readonly string $register,
        private readonly int $value,
        private readonly string $otherRegister,
        private readonly Comparison $comparison,
        private readonly int $otherValue,
    ) {
    }
}
