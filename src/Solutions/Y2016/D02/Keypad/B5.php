<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D02\Keypad;

use App\Solutions\Y2016\D02\Move\Direction;

final class B5 implements Button
{
    public function move(Direction $direction): Button
    {
        return match ($direction) {
            Direction::Up => new B2(),
            Direction::Down => new B8(),
            Direction::Left => new B4(),
            Direction::Right => new B6(),
        };
    }

    public function value(): int
    {
        return 5;
    }
}
