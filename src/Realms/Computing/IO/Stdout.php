<?php
declare(strict_types=1);

namespace App\Realms\Computing\IO;

final class Stdout implements OutputDevice
{
    private array $outputBuffer = [];

    public function write(mixed $value): void
    {
        $this->outputBuffer[] = $value;
    }

    public function consumeOutputBuffer(): iterable
    {
        return array_splice($this->outputBuffer, 0);
    }
}
