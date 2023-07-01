<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D17;

use Stringable;

final readonly class Door implements Stringable
{
    public static function of(Direction $direction, Lock $lock): self
    {
        return new self($direction, $lock);
    }

    private function __construct(public Direction $direction, private Lock $lock)
    {
    }

    public function allowsPassage(): bool
    {
        return $this->lock->allowsPassage();
    }

    public function __toString(): string
    {
        $direction = $this->direction->name;
        $lock = $this->lock->name;
        return "$direction $lock";
    }
}
