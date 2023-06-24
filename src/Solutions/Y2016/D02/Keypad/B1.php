<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D02\Keypad;

use App\Solutions\Y2016\D02\Move\Direction;

final class B1 implements Button
{
    public function move(Direction $direction): Button
    {
        return match ($direction) {
            Direction::Down => new B4(),
            Direction::Right => new B2(),
            default => $this,
        };
    }

    public function value(): int
    {
        return 1;
    }
}
