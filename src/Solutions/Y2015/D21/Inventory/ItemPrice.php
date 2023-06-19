<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D21\Inventory;

use Stringable;

final readonly class ItemPrice implements Stringable
{
    public static function of(int $price, Item $item): self
    {
        return new self($price, $item);
    }

    private function __construct(public int $price, public Item $item)
    {
        assert($this->price > 0);
    }

    public function __toString(): string
    {
        return "\${$this->price} $this->item";
    }
}
