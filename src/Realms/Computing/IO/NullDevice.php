<?php
declare(strict_types=1);

namespace App\Realms\Computing\IO;

use RuntimeException;

final class NullDevice implements InputDevice, OutputDevice
{
    public function nextValue(): int
    {
        throw new RuntimeException('Input device not connected');
    }

    public function write(mixed $value): void
    {
        throw new RuntimeException('Output device not connected');
    }

    public function consumeOutputBuffer(): iterable
    {
        return [];
    }
}
