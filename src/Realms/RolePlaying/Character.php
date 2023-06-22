<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying;

use App\Realms\RolePlaying\Combat\PhysicalAttack;
use App\Realms\RolePlaying\Inventory\Item;
use App\Realms\RolePlaying\Magic\Problems\NotEnoughMana;
use App\Realms\RolePlaying\Magic\Spell;
use loophp\collection\Collection;
use Stringable;

final class Character implements Stringable
{
    public static function of(string $name, int $hitPoints, int $mana, Item|Spell ...$itemsOrSpells): self
    {
        $collection = Collection::fromIterable($itemsOrSpells);
        $items = $collection->filter(static fn ($item) => $item instanceof Item);
        $spells = $collection->filter(static fn ($item) => $item instanceof Spell);
        $armor = $items->reduce(static fn (int $sum, Item $item) => $sum + $item->armor, 0);
        $attack = $items->reduce(static fn (int $sum, Item $item) => $sum + $item->damage, 0);

        return new Character($name, $hitPoints, $mana, $armor, $attack, $spells->all());
    }

    private function __construct(
        public readonly string $name,
        private int $hitPoints,
        private int $mana,
        private int $armor,
        public readonly int $attack,
        /** @var Spell[] */
        public array $spells,
    ) {
        assert($this->hitPoints > 0);
        assert($this->armor >= 0);
        assert($this->attack >= 0);
    }

    /**
     * @throws NotEnoughMana
     */
    public function performAttack(self $opponent): PhysicalAttack|Spell
    {
        if ($this->attack > 0) {
            return PhysicalAttack::of($this, $opponent);
        }

        return $this->castSpell();
    }

    /**
     * @throws NotEnoughMana
     */
    public function castSpell(): Spell
    {
        $spell = array_shift($this->spells);
        $this->spells[] = $spell;
        NotEnoughMana::whenCostGreaterThanMana($spell->cost, $this->mana);
        $this->mana -= $spell->cost;
        return $spell;
    }

    public function armor(): int
    {
        return $this->armor;
    }

    public function gainHitPoints(int $value): void
    {
        assert($value >= 0);
        $this->hitPoints += $value;
    }

    public function reduceHitPoints(int $value): void
    {
        assert($value >= 0);
        $this->hitPoints -= $value;
    }

    public function mana(): int
    {
        return $this->mana;
    }

    public function gainMana(int $value): void
    {
        assert($value >= 0);
        $this->mana += $value;
    }

    public function increaseArmor(int $value): void
    {
        assert($value >= 0);
        $this->armor += $value;
    }

    public function reduceArmor(int $value): void
    {
        assert($value >= 0);
        $this->armor -= $value;
    }

    public function kill(): void
    {
        $this->hitPoints = 0;
    }

    public function isDead(): bool
    {
        return $this->hitPoints <= 0;
    }

    public function isAlive(): bool
    {
        return false === $this->isDead();
    }

    public function hitPoints(): int
    {
        return $this->hitPoints;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
