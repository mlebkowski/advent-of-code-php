<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D21\Strategy;

use App\Solutions\Y2015\D21\Inventory\Item;
use App\Solutions\Y2015\D21\Inventory\ItemPrice;
use loophp\collection\Collection;
use Stringable;

final readonly class ShoppingCart implements Stringable
{
    public static function of(array $items): self
    {
        $price = Collection::fromIterable($items)
            ->map(static fn (ItemPrice $item) => $item->price)
            ->reduce(static fn (int $sum, int $price) => $sum + $price, 0);

        $items = Collection::fromIterable($items)
            ->map(static fn (ItemPrice $item) => $item->item)
            ->all();

        return new self($price, $items);
    }

    public static function cheapest(self $alpha, self $bravo): int
    {
        return $alpha->price <=> $bravo->price;
    }

    public static function providesEnoughPoints(int $pointsRequired): callable
    {
        return static function (self $cart) use ($pointsRequired) {
            $points = Collection::fromIterable($cart->items)
                ->map(static fn (Item $item) => $item->largestAttribute())
                ->reduce(static fn (int $sum, int $points) => $points + $sum, 0);

            return $points >= $pointsRequired;
        };
    }

    private function __construct(public int $price, private array $items)
    {
    }

    public function __toString(): string
    {
        $items = Collection::fromIterable($this->items)
            ->map(static fn (Item $item) => $item->name)
            ->implode(', ');
        return "\${$this->price} $items";
    }
}
