<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D07;

use loophp\collection\Collection;
use RuntimeException;

final class AssemblyProcess
{
    public static function ofRules(AssemblyRule ...$rules): self
    {
        $steps = Collection::fromIterable($rules)
            ->flatMap(static fn (AssemblyRule $rule) => [$rule->step, $rule->requirement])
            ->distinct()
            ->sort()
            ->flip()
            ->all(false);

        $requirements = Collection::fromIterable($rules)
            ->map(static fn (AssemblyRule $rule) => [$rule->step, $rule->requirement])
            ->unpack()
            ->groupBy(static fn ($value, string $key) => $key)
            ->all(false);

        return new self($steps, $requirements);
    }

    private function __construct(private array $steps, private array $requirements)
    {
    }

    public function consume(): string
    {
        try {
            return $this->currentStep()
                ?? throw new RuntimeException('Cannot consume if there is no next step ready');
        } finally {
            $this->next();
        }
    }

    public function currentStep(): ?string
    {
        return key(array_diff_key($this->steps, $this->requirements));
    }

    public function done(string $done): void
    {
        foreach ($this->requirements as $step => $items) {
            $this->requirements[$step] = array_diff($items, [$done]);
            if (!$this->requirements[$step]) {
                unset($this->requirements[$step]);
            }
        }
    }

    public function hasStepsLeft(): bool
    {
        return count($this->steps) > 0;
    }

    private function next(): void
    {
        $current = $this->currentStep()
            ?? throw new RuntimeException('Cannot advance if there is no next step ready!');

        $this->steps = array_diff_key($this->steps, [$current => true]);
    }
}
