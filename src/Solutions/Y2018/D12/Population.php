<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D12;

use loophp\collection\Collection;
use Stringable;

final readonly class Population implements Stringable
{
    public static function of(array $pots, array $rules): self
    {
        return new self(self::surroundWithEmptyPots($pots), $rules, 4);
    }

    private function __construct(
        /** @var Pot[] */
        private array $pots,
        /** @var Rule[] */
        private array $rules,
        private int $offset,
    ) {
    }

    public function magicNumber(): int
    {
        return Collection::fromIterable($this->pots)
            ->reject(static fn (Pot $pot) => $pot->isEmpty())
            ->keys()
            ->map(fn (int $key) => $key - $this->offset)
            ->reduce(static fn (int $sum, int $pot) => $sum + $pot, 0);
    }

    public function step(): self
    {
        $pots = Collection::fromIterable($this->pots)
            ->keys()
            ->slice(2, count($this->pots) - 4)
            ->map($this->nextGeneration(...))
            ->all();

        return new self(
            self::surroundWithEmptyPots($pots),
            $this->rules,
            $this->offset + 2,
        );
    }

    private function nextGeneration(int $index): Pot
    {
        $neighbours = array_slice($this->pots, $index - 2, 5);

        foreach ($this->rules as $rule) {
            if ($rule->matches(...$neighbours)) {
                return $rule->result;
            }
        }
        return Pot::Empty;
    }

    private static function surroundWithEmptyPots(array $pots): array
    {
        return [
            Pot::Empty,
            Pot::Empty,
            Pot::Empty,
            Pot::Empty,
            ...$pots,
            Pot::Empty,
            Pot::Empty,
            Pot::Empty,
            Pot::Empty,
        ];
    }

    public function __toString(): string
    {
        return Collection::fromIterable($this->pots)
            ->map(static fn (Pot $pot) => $pot->value)
            ->implode();
    }
}
