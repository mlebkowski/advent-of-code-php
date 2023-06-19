<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D21\Inventory;

use App\Solutions\Y2015\D21\Problems\NoItemByThatName;
use loophp\collection\Collection;

final class ItemShop
{
    public static function of(ItemPrice ...$itemPrices): self
    {
        $indexed = Collection::fromIterable($itemPrices)
            ->map(static fn (ItemPrice $price) => [$price->item->name, $price])
            ->unpack()
            ->all(false);

        return new self($indexed);
    }

    private function __construct(/** @var ItemPrice[] */ private readonly array $items)
    {
    }

    /**
     * @throws NoItemByThatName
     */
    public function get(string $name): Item
    {
        return $this->items[$name]?->item ?? throw NoItemByThatName::ofName($name);
    }
}
