<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D10;

final readonly class TransferOut
{
    public static function of(int $botId, int $low, int $high): self
    {
        return new self($botId, $low, $high);
    }

    private function __construct(public int $botId, public int $low, public int $high)
    {
    }

    public function matches(int $low, int $high): bool
    {
        return $this->low === $low && $this->high === $high;
    }
}
