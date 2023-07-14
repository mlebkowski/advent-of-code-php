<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D17;

final readonly class Water
{
    public static function of(int $retained, int $all): self
    {
        return new self($retained, $all);
    }

    private function __construct(public int $retained, public int $all)
    {
    }
}
