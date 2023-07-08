<?php
declare(strict_types=1);

namespace App\Realms\Computing\Instruction;

use App\Realms\Computing\IO\SoundDevice;
use App\Realms\Computing\Processor\Processor;
use App\Realms\Computing\Processor\Register;

final readonly class Sound implements Instruction
{
    public static function of(Register|int $value): self
    {
        return new self($value);
    }

    private function __construct(private Register|int $value)
    {
    }

    public function apply(Processor $processor): void
    {
        $processor->getDevice(SoundDevice::class)->play(
            $processor->readValue($this->value),
        );
    }

    public function __toString(): string
    {
        $v = $this->value?->value ?? $this->value;
        return "snd $v";
    }
}