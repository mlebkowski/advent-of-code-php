<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D01\Input;

use App\Solutions\Y2016\D01\Turn;

final readonly class Instruction
{
    public static function of(Turn $turn, int $distance): self
    {
        return new self($turn, $distance);
    }

    public function __construct(public Turn $turn, public int $distance)
    {
    }
}
