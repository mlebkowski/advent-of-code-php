<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D21\Inventory;

final readonly class Item
{
    public static function of(string $name, int $damage, int $armor, ItemType $type): self
    {
        return new self($name, $damage, $armor, $type);
    }

    private function __construct(
        public string $name,
        public int $damage,
        public int $armor,
        public ItemType $type,
    ) {
    }

    public function isArmor(): bool
    {
        return $this->type === ItemType::Armor;
    }

    public function isWeapon(): bool
    {
        return $this->type === ItemType::Weapon;
    }

    public function isRing(): bool
    {
        return $this->type === ItemType::Ring;
    }
}
