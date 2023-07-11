<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D07;

use RuntimeException;

final readonly class Workforce
{
    public static function of(int $count): self
    {
        return new self(
            array_map(
                static fn () => Worker::idle(),
                range(1, $count),
            ),
        );
    }

    private function __construct(/** @var Worker[] */ private array $workers)
    {
    }

    public function completedSteps(): iterable
    {
        foreach ($this->workers as $worker) {
            if ($worker->isDone()) {
                yield $worker->take();
            }
        }
    }

    public function hasCapacity(): bool
    {
        foreach ($this->workers as $worker) {
            if ($worker->isIdle()) {
                return true;
            }
        }
        return false;
    }

    public function isOccupied(): bool
    {
        foreach ($this->workers as $worker) {
            if ($worker->isOccupied()) {
                return true;
            }
        }
        return false;
    }

    public function startWorking(string $step, int $stepDuration): void
    {
        foreach ($this->workers as $worker) {
            if ($worker->isIdle()) {
                $worker->startWorking($step, $stepDuration + ord($step) - ord('A') + 1);
                return;
            }
        }
        throw new RuntimeException('There is no idle worker');
    }

    public function status(): array
    {
        return array_map(
            static fn (Worker $worker) => $worker->status(),
            $this->workers,
        );
    }

    public function work(): void
    {
        foreach ($this->workers as $worker) {
            $worker->work();
        }
    }
}
