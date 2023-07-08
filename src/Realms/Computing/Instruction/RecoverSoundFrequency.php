<?php
declare(strict_types=1);

namespace App\Realms\Computing\Instruction;

use App\Realms\Computing\IO\SoundDevice;
use App\Realms\Computing\IO\Stdout;
use App\Realms\Computing\Processor\Processor;
use App\Realms\Computing\Processor\Register;

final readonly class RecoverSoundFrequency implements Instruction
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
        if (0 === $processor->readValue($this->value)) {
            return;
        }

        $sound = $processor->getDevice(SoundDevice::class);
        $processor->getDevice(Stdout::class)->write(end($sound->log));
    }

    public function __toString(): string
    {
        $v = $this->value?->value ?? $this->value;
        return "rcv $v";
    }
}
