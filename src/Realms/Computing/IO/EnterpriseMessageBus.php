<?php
declare(strict_types=1);

namespace App\Realms\Computing\IO;

use App\Realms\Computing\IO\Problems\ReadWait;
use App\Realms\Computing\Processor\Processor;

final class EnterpriseMessageBus implements InputDevice
{
    private array $queue = [];

    public static function between(Processor $alpha, Processor $bravo): void
    {
        $alpha->attachInputDevice(self::of($bravo->getOutputDevice()));
        $bravo->attachInputDevice(self::of($alpha->getOutputDevice()));

        $bravoThread = $bravo->start();
        $alphaThread = $alpha->start();

        while ($alphaThread->valid() && $bravoThread->valid()) {
            $signal = $bravoThread->current();
            if ($signal instanceof ReadWait) {
                [$alphaThread, $bravoThread] = [$bravoThread, $alphaThread];
            }
            $bravoThread->next();
        }
    }

    public static function of(OutputDevice $device): self
    {
        return new self($device);
    }

    private function __construct(private readonly OutputDevice $stdin)
    {
    }

    public function nextValue(): int
    {
        $this->queue = [
            ...$this->queue,
            ...$this->stdin->consumeOutputBuffer(),
        ];

        $this->queue || throw new ReadWait();

        return array_shift($this->queue);
    }
}
