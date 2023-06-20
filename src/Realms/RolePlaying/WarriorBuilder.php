<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying;

use App\Realms\RolePlaying\Inventory\Item;
use App\Realms\RolePlaying\Inventory\ItemType;
use App\Realms\RolePlaying\Inventory\Problems\CannotWearMultipleArmors;
use App\Realms\RolePlaying\Inventory\Problems\CannotWearTooManyRings;
use App\Realms\RolePlaying\Inventory\Problems\NoDualWielding;
use App\Realms\RolePlaying\Inventory\Problems\WeaponNotEquipped;
use loophp\collection\Collection;

final class WarriorBuilder
{
    private string $name = "player";
    private int $hitPoints = 100;
    private array $items = [];

    public static function start(): self
    {
        return new self();
    }

    public function withHitPoints(int $hitPoints): self
    {
        $this->hitPoints = $hitPoints;
        return $this;
    }

    public function withName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function withItems(Item ...$items): self
    {
        $this->items = array_merge($this->items, $items);
        return $this;
    }

    /**
     * @throws WeaponNotEquipped
     * @throws NoDualWielding
     * @throws CannotWearMultipleArmors
     * @throws CannotWearTooManyRings
     */
    public function build(): Character
    {
        $items = Collection::fromIterable($this->items);

        $countByType = static fn (ItemType $type) => $items
            ->filter(static fn (Item $item) => $item->type->is($type))
            ->count();

        WeaponNotEquipped::whenNoWeapon($countByType(ItemType::Weapon));
        NoDualWielding::whenMoreThanOneWeapon($countByType(ItemType::Weapon));
        CannotWearMultipleArmors::whenMoreThanOneArmor($countByType(ItemType::Armor));
        CannotWearTooManyRings::whenMoreThanTwoRings($countByType(ItemType::Ring));

        return Character::of($this->name, $this->hitPoints, ...$this->items);
    }
}
