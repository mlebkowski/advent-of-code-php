<?php
declare(strict_types=1);

namespace App\Realms\Computing\IO;

interface OutputDevice
{
    public function write(mixed $value): void;

    public function consumeOutputBuffer(): iterable;
}
