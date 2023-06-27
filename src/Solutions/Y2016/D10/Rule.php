<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D10;

use Stringable;

final readonly class Rule implements Stringable
{
    public static function of(int $botId, Target $low, Target $high): self
    {
        return new self($botId, $low, $high);
    }

    private function __construct(public int $botId, public Target $low, public Target $high)
    {
    }

    public function __toString(): string
    {
        return sprintf('→ %s → %s', $this->low, $this->high);
    }
}
