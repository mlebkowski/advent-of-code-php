<?php
declare(strict_types=1);

namespace App\Realms\Computing\Optimizer;

use App\Realms\Computing\Instruction\Instruction;
use App\Realms\Computing\Processor\Processor;
use App\Realms\Computing\Processor\Register;

final readonly class IsPrime implements Instruction
{
    public static function of(Register $register, Register|int $value): self
    {
        return new self($register, $value);
    }

    private function __construct(private Register $register, private Register|int $value)
    {
    }

    public function apply(Processor $processor): void
    {
        $processor->setRegister(
            $this->register,
            $this->isPrime($processor->readValue($this->value)) ? 1 : 0,
        );
    }

    private function isPrime(int $num): bool
    {
        for ($i = 2, $s = sqrt($num); $i <= $s; $i++) {
            if ($num % $i === 0) {
                return false;
            }
        }
        return $num > 1;
    }

    public function __toString(): string
    {
        $register = $this->register->value;
        $value = $this->value?->value ?? $this->value;
        return "is-prime $register $value";
    }
}
