<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D02\Keypad;

use App\Solutions\Y2016\D02\Move\Direction;

interface Button
{
    public function move(Direction $direction): Button;

    public function value(): int;
}
