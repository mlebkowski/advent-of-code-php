<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D02\Keypad;

use App\Solutions\Y2016\D02\Move\Direction;

final class B4 implements Button
{
    public function move(Direction $direction): Button
    {
        return match ($direction) {
            Direction::Up => new B1(),
            Direction::Down => new B7(),
            Direction::Right => new B5(),
            default => $this,
        };
    }

    public function value(): int
    {
        return 4;
    }
}
