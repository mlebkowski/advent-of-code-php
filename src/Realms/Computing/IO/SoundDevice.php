<?php
declare(strict_types=1);

namespace App\Realms\Computing\IO;

final class SoundDevice implements Device
{
    public array $log = [];

    public static function muted(): self
    {
        return new self(volume: 0);
    }

    private function __construct(private readonly int $volume)
    {
    }

    public function play(int $frequency): void
    {
        $this->log[] = $frequency;
        if ($this->volume > 0) {
            exec("play -qn synth 3 sin $frequency");
        }
    }

    public function consumeOutputBuffer(): iterable
    {
        return array_splice($this->log, 0);
    }
}
