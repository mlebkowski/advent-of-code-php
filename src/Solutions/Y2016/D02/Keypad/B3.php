<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D02\Keypad;

use App\Solutions\Y2016\D02\Move\Direction;

final class B3 implements Button
{
    public function move(Direction $direction): Button
    {
        return match ($direction) {
            Direction::Down => new B6(),
            Direction::Left => new B2(),
            default => $this,
        };
    }

    public function value(): int
    {
        return 3;
    }
}
