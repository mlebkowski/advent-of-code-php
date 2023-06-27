<?php
declare(strict_types=1);

namespace App\Realms\Computing\Instruction;

use App\Realms\Computing\Processor\Processor;
use App\Realms\Computing\Processor\Register;

final readonly class Copy implements Instruction
{
    public static function of(Register|int $value, Register $target): self
    {
        return new self($value, $target);
    }

    private function __construct(private Register|int $value, private Register $target)
    {
    }

    public function apply(Processor $processor): void
    {
        $processor->setRegister(
            $this->target,
            $this->value instanceof Register ? $processor->readRegister($this->value) : $this->value,
        );
    }

    public function __toString(): string
    {
        $alpha = $this->value?->value ?? $this->value;
        return sprintf("cpy %s %s", $alpha, $this->target->value);
    }
}
