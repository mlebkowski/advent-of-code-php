<?php
declare(strict_types=1);

namespace App\Realms\Computing\Optimizer;

use App\Realms\Computing\Instruction\Instruction;

final readonly class Optimizer
{
    public static function of(Optimization ...$optimizations): self
    {
        return new self($optimizations);
    }

    private function __construct(private array $optimizations)
    {
    }

    public function optimize(Instruction ...$instructions): array
    {
        return array_reduce(
            $this->optimizations,
            static fn (array $instructions, Optimization $optimization) => $optimization->optimize(...$instructions),
            $instructions,
        );
    }
}
