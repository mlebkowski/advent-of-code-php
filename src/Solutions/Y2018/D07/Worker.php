<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D07;

final class Worker
{
    private ?string $step = null;
    private int $timeLeft = 0;

    public static function idle(): self
    {
        return new self();
    }

    public function startWorking(string $step, int $time): void
    {
        assert(null === $this->step);
        $this->step = $step;
        $this->timeLeft = $time;
    }

    public function isIdle(): bool
    {
        return null === $this->step;
    }

    public function isOccupied(): bool
    {
        return null !== $this->step;
    }

    public function status(): string
    {
        return $this->step ?? '.';
    }

    public function work(): void
    {
        $this->timeLeft--;
    }

    public function isDone(): bool
    {
        return $this->step && $this->timeLeft <= 0;
    }

    public function take(): string
    {
        assert(null !== $this->step);
        try {
            return $this->step;
        } finally {
            $this->step = null;
        }
    }
}
