<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Inventory;

use Stringable;

final readonly class Item implements Stringable
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
        assert($this->damage > 0 || $type !== ItemType::Weapon);
        assert($this->armor > 0 || $type !== ItemType::Armor);
        assert($this->armor >= 0 || $this->damage >= 0);
    }

    public function largestAttribute(): int
    {
        return max($this->damage, $this->armor);
    }

    public function __toString(): string
    {
        return "$this->name ({$this->type->name}) {atk: $this->damage, def: $this->armor}";
    }
}
