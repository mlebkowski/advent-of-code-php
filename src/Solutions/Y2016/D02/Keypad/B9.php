<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D02\Keypad;

use App\Solutions\Y2016\D02\Move\Direction;

final class B9 implements Button
{
    public function move(Direction $direction): Button
    {
        return match ($direction) {
            Direction::Up => new B6(),
            Direction::Left => new B8(),
            default => $this,
        };
    }

    public function value(): int
    {
        return 9;
    }
}
