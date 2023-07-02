<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D22;

use App\Realms\Cartography\Point;
use Stringable;

final class Node implements Stringable
{
    public static function of(int $x, int $y, int $size, int $used): self
    {
        return new self(Point::of($x, $y), $size, $used);
    }

    public static function isViablePair(self $alpha, self $bravo): bool
    {
        return false === $alpha->isEmpty()
            && false === $alpha->isSame($bravo)
            && $bravo->wouldFit($alpha);
    }

    private function __construct(private Point $point, private int $size, private int $used)
    {
        assert($size >= $used && $used >= 0);
    }

    private function isEmpty(): bool
    {
        return 0 === $this->used;
    }

    private function isSame(self $other): bool
    {
        return $this->point->equals($other->point);
    }

    private function wouldFit(self $other): bool
    {
        return $this->used + $other->used <= $this->size;
    }

    public function __toString(): string
    {
        return "node-x{$this->point->x}-y{$this->point->y}";
    }
}
