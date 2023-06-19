<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D21\Inventory;

final readonly class ItemPrice
{
    public static function of(int $price, Item $item): self
    {
        return new self($price, $item);
    }

    public function __construct(public int $price, public Item $item)
    {
    }
}
