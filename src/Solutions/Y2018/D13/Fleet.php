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
        $this->sort();
    }

    public function current(): Cart
    {
        return $this->carts[$this->position];
    }

    public function step(string $gricSpace): Cart
    {
        $this->carts[$this->position] = $cart = $this->current()->move($gricSpace);
        $this->position++;

        if (0 === $this->position % count($this->carts)) {
            $this->sort();
            $this->position = 0;
        }

        return $cart;
    }

    public function getIterator(): Traversable
    {
        yield from $this->carts;
    }

    private function sort(): void
    {
        usort(
            $this->carts,
            CartSort::byMovementOrder(...),
        );
    }
}
