<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D21;

use loophp\collection\Collection;

final class Character
{
    public static function of(int $hitPoints, Item ...$items): self
    {
        $armor = Collection::fromIterable($items)
            ->reduce(static fn (int $sum, Item $item) => $sum + $item->armor, 0);

        return new Character($hitPoints, $armor);
    }

    private function __construct(private int $hitPoints, private readonly int $armor)
    {
        assert($this->hitPoints > 0);
        assert($this->armor >= 0);
    }

    public function receiveAttack(int $damage): void
    {
        $damage -= $this->armor;
        $this->hitPoints -= max(1, $damage);
    }

    public function isDead(): bool
    {
        return $this->hitPoints <= 0;
    }

    public function hitPoints(): int
    {
        return $this->hitPoints;
    }
}
