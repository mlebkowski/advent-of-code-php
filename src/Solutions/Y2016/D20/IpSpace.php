<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D20;

final readonly class IpSpace
{
    public static function empty(): self
    {
        return new self(minValue: 0, allowedCount: 0, maxBlocked: 0);
    }

    private function __construct(public int $minValue, public int $allowedCount, private int $maxBlocked)
    {

    }

    public function applyRange(Range $range): self
    {
        $minValue = $range->blocks($this->minValue) ? $range->max + 1 : $this->minValue;

        $allowedCount = $this->allowedCount;
        if (false === $range->blocks($this->maxBlocked)) {
            $allowedCount += max(0, $range->min - $this->maxBlocked - 1);
        }

        $maxBlocked = max($this->maxBlocked, $range->max);

        return new self(minValue: $minValue, allowedCount: $allowedCount, maxBlocked: $maxBlocked);
    }
}
