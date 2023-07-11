<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D01;

final class FrequencyEmitter
{
    public static function of(): self
    {
        return new self(0);
    }
    private function __construct(private int $frequency)
    {

    }

    public function emit(int $change): int
    {
        return $this->frequency += $change;
    }
}
