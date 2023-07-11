<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D04;

use DateTimeImmutable;

final readonly class Sleep
{
    public static function of(DateTimeImmutable $start, DateTimeImmutable $end): self
    {
        return new self((int)$start->format('i'), (int)$end->format('i'));
    }

    private function __construct(public int $start, public int $end)
    {
    }

    public function length(): int
    {
        return $this->end - $this->start;
    }
}
