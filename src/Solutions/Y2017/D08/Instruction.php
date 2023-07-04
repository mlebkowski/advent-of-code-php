<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D08;

use ArrayObject;

final readonly class Instruction
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
        private string $register,
        private int $value,
        private string $otherRegister,
        private Comparison $comparison,
        private int $otherValue,
    ) {
    }

    public function apply(ArrayObject $registers): void
    {
        $regValue = $registers[$this->otherRegister] ?? 0;
        if (false === $this->comparison->evaluate($regValue, $this->otherValue)) {
            return;
        }
        $value = $registers[$this->register] ?? 0;
        $registers[$this->register] = $value + $this->value;
    }
}
