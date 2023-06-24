<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D02\Keypad;

use App\Solutions\Y2016\D02\Move\Direction;

final class B2 implements Button
{
    public function move(Direction $direction): Button
    {
        return match ($direction) {
            Direction::Down => new B5(),
            Direction::Right => new B3(),
            Direction::Left => new B1(),
            default => $this,
        };
    }

    public function value(): int
    {
        return 2;
    }
}
