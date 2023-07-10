<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D24;

final class StrategyLongest
{
    public static function of(): self
    {
        return new self(0, 0);
    }

    private function __construct(private int $length, private int $strength)
    {
    }

    public function reduce(?int $strength, Bridge $bridge): int
    {
        if ($bridge->length() < $this->length) {
            return $this->strength;
        }

        if ($bridge->length() > $this->length) {
            $this->length = $bridge->length();
            return $this->strength = $bridge->strength();
        }

        $this->length = $bridge->length();
        return $this->strength = max($bridge->strength(), $this->strength);
    }
}
