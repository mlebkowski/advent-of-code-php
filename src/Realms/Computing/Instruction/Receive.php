<?php
declare(strict_types=1);

namespace App\Realms\Computing\Instruction;

use App\Realms\Computing\Processor\Processor;
use App\Realms\Computing\Processor\Register;

final readonly class Receive implements Instruction
{
    public static function of(Register $register): self
    {
        return new self($register);
    }

    private function __construct(private Register $register)
    {
    }

    public function apply(Processor $processor): void
    {
        $processor->setRegister(
            $this->register,
            $processor->getInputDevice()->nextValue(),
        );
    }

    public function __toString(): string
    {
        $v = $this->register?->value ?? $this->register;
        return "rcv $v";
    }
}
