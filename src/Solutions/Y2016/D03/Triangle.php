<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D03;

use App\Solutions\Y2016\D03\Problems\TooShortSides;

final readonly class Triangle
{
    public static function tryOf(int $alpha, int $bravo, int $charlie): ?self
    {
        try {
            return new self($alpha, $bravo, $charlie);
        } catch (TooShortSides) {
            return null;
        }
    }

    /**
     * @throws TooShortSides
     */
    private function __construct(private int $alpha, private int $bravo, private int $charlie)
    {
        TooShortSides::whenOneIsLongerThanTheOtherTwo(
            $alpha + $bravo <= $charlie
            || $alpha + $charlie <= $bravo
            || $bravo + $charlie <= $alpha,
            $this->alpha,
            $this->bravo,
            $this->charlie,
        );
    }
}
