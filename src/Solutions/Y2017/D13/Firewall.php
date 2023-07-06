<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D13;

use loophp\collection\Collection;

final readonly class Firewall
{
    public static function of(Spec ...$spec): self
    {
        return new self($spec);
    }

    private function __construct(public array $specs)
    {
    }

    public function maxDepth(): int
    {
        return Collection::fromIterable($this->specs)
            ->map(static fn (Spec $spec) => $spec->depth)
            ->max();
    }

    public function maxRange(): int
    {
        return Collection::fromIterable($this->specs)
            ->map(static fn (Spec $spec) => $spec->range)
            ->max();
    }

    public function tripSeverity(): int
    {
        return Collection::fromIterable($this->specs)
            ->filter(static fn (Spec $spec) => $spec->catchesPacket())
            ->reduce(static fn (int $sum, Spec $spec) => $sum + $spec->severity(), 0);
    }

    public function avoidsDetection(int $delay): bool
    {
        return Collection::fromIterable($this->specs)
            ->every(static fn (Spec $spec) => false === $spec->catchesPacket($delay));
    }
}
