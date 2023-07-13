<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D13;

use IteratorAggregate;
use Traversable;

/** @implements IteratorAggregate<int,Cart> */
final class Fleet implements IteratorAggregate
{
    private int $position = 0;

    public static function of(Cart ...$carts): self
    {
        return new self($carts);
    }

    private function __construct(/** @var Cart[] */ private array $carts)
    {
        $this->cleanup();
    }

    public function count(): int
    {
        return count($this->carts);
    }

    public function remove(Cart ...$carts): void
    {
        $this->carts = array_map(
            static fn (Cart $cart) => in_array($cart, $carts, true) ? $cart->ghost() : $cart,
            $this->carts,
        );
    }

    public function current(): Cart
    {
        return $this->carts[$this->position];
    }

    public function step(string $gricSpace): Cart
    {
        $this->carts[$this->position] = $cart = $this->current()->move($gricSpace);
        $this->position++;

        while (false === $this->tickComplete() && $this->current()->isGhost()) {
            $this->position++;
        }

        return $cart;
    }

    public function tick(): void
    {
        assert($this->tickComplete());
        $this->cleanup();
    }

    public function tickComplete(): bool
    {
        return $this->position === count($this->carts);
    }

    public function getIterator(): Traversable
    {
        yield from $this->carts;
    }

    private function cleanup(): void
    {
        $this->position = 0;
        $this->carts = array_filter(
            $this->carts,
            static fn (Cart $cart) => false === $cart->isGhost(),
        );
        usort(
            $this->carts,
            CartSort::byMovementOrder(...),
        );
    }
}
