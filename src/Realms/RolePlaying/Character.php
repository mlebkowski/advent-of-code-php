<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying;

use App\Realms\RolePlaying\Inventory\Item;
use App\Realms\RolePlaying\Inventory\ItemType;
use App\Realms\RolePlaying\Inventory\Problems\CannotWearMultipleArmors;
use App\Realms\RolePlaying\Inventory\Problems\CannotWearTooManyRings;
use App\Realms\RolePlaying\Inventory\Problems\InventoryProblem;
use App\Realms\RolePlaying\Inventory\Problems\NoDualWielding;
use App\Realms\RolePlaying\Inventory\Problems\WeaponNotEquipped;
use loophp\collection\Collection;
use Stringable;

final class Character implements Stringable
{
    /**
     * @throws InventoryProblem
     * @throws CannotWearTooManyRings
     * @throws WeaponNotEquipped
     * @throws CannotWearMultipleArmors
     * @throws NoDualWielding
     */
    public static function of(string $name, int $hitPoints, Item ...$items): self
    {
        $items = Collection::fromIterable($items);

        $countByType = static fn (ItemType $type) => $items
            ->filter(static fn (Item $item) => $item->type->is($type))
            ->count();

        WeaponNotEquipped::whenNoWeapon($countByType(ItemType::Weapon));
        NoDualWielding::whenMoreThanOneWeapon($countByType(ItemType::Weapon));
        CannotWearMultipleArmors::whenMoreThanOneArmor($countByType(ItemType::Armor));
        CannotWearTooManyRings::whenMoreThanTwoRings($countByType(ItemType::Ring));

        $armor = $items->reduce(static fn (int $sum, Item $item) => $sum + $item->armor, 0);
        $attack = $items->reduce(static fn (int $sum, Item $item) => $sum + $item->damage, 0);

        return new Character($name, $hitPoints, $armor, $attack);
    }

    private function __construct(
        public readonly string $name,
        private int $hitPoints,
        public readonly int $armor,
        public readonly int $attack,
    ) {
        assert($this->hitPoints > 0);
        assert($this->armor >= 0);
        assert($this->attack >= 0);
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
