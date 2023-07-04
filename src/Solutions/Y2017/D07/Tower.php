<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D07;

use loophp\collection\Collection;

final readonly class Tower
{
    public static function of(Program $root, Tower|Program ...$items): self
    {
        return new self($root, $items);
    }

    private function __construct(public Program $root, public array $items)
    {
        assert(count($this->items) > 1);
    }

    public function balance(): int
    {
        $weights = $this->itemWeights();
        return min(...$weights) - max(...$weights);
    }

    public function findImbalancedTower(): ?Tower
    {
        if (0 === $this->balance()) {
            return null;
        }

        $weights = $this->itemWeights();
        $average = array_sum($weights) / count($weights);

        $idx = Collection::fromIterable($weights)
            ->map(static fn (int $weight) => abs($weight - $average))
            ->sort()
            ->keys()
            ->last();

        return $this->items[$idx];
    }

    public function weight(): int
    {
        return $this->root->weight() + array_sum($this->itemWeights());
    }

    public function toTree(): array
    {
        return [
            $this->root->name => array_merge(
                ...
                array_map(
                    static fn (Program|Tower $item) => $item->toTree(),
                    $this->items,
                ),
            ),
        ];
    }

    private function itemWeights(): array
    {
        return array_map(
            static fn (Program|Tower $item) => $item->weight(),
            $this->items,
        );
    }
}
