<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D17;

use loophp\collection\Collection;
use Stringable;

final readonly class Path implements Stringable
{
    public static function empty(): self
    {
        return new self([], x: 0, y: 0);
    }

    private function __construct(
        private array $steps,
        private int $x,
        private int $y,
    ) {
    }

    public function go(Direction $direction): self
    {
        $x = match ($direction) {
            Direction::Left => $this->x - 1,
            Direction::Right => $this->x + 1,
            Direction::Down, Direction::Up => $this->x,
        };

        $y = match ($direction) {
            Direction::Up => $this->y - 1,
            Direction::Down => $this->y + 1,
            Direction::Left, Direction::Right => $this->y,
        };

        return new self([...$this->steps, $direction], x: $x, y: $y);
    }

    public function leadsOutsideGrid(Door $door, Environment $environment): bool
    {
        return match ($door->direction) {
            Direction::Down => $this->y + 1 >= $environment->height,
            Direction::Up => $this->y <= 0,
            Direction::Left => $this->x <= 0,
            Direction::Right => $this->x + 1 >= $environment->width,
        };
    }

    public function length(): int
    {
        return count($this->steps);
    }

    public function isVault(Environment $environment): bool
    {
        return $this->x + 1 === $environment->width && $this->y + 1 === $environment->height;
    }

    public function __toString(): string
    {
        return Collection::fromIterable($this->steps)
            ->map(static fn (Direction $direction) => $direction->value)
            ->implode();
    }
}
