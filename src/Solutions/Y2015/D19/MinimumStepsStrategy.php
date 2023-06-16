<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19;

use Stringable;

final readonly class MinimumStepsStrategy implements Stringable
{
    public static function empty(): self
    {
        return new self(PHP_INT_MAX, null);
    }

    private function __construct(private int $minSteps, private Procedure|null $procedure)
    {
    }

    public function apply(Procedure $procedure): self
    {
        if ($this->minSteps > $procedure->stepsCount()) {
            return new self($procedure->stepsCount(), $procedure);
        }

        return $this;
    }

    public function steps(): int
    {
        return $this->minSteps;
    }

    public function __toString(): string
    {
        if ($this->procedure) {
            return "$this->minSteps: $this->procedure";
        }

        return "$this->minSteps";
    }
}
