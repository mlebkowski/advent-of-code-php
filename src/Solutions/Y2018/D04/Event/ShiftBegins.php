<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D04\Event;

use DateTimeImmutable;

final readonly class ShiftBegins implements Event
{
    public static function of(DateTimeImmutable $on, int $guardId): self
    {
        return new self($on, $guardId);
    }

    private function __construct(public DateTimeImmutable $on, public int $guardId)
    {
    }

    public function timestamp(): DateTimeImmutable
    {
        return $this->on;
    }

    public function __toString(): string
    {
        return sprintf("[%s] Guard #%d begins shift", $this->on->format('Y-m-d H:i'), $this->guardId);
    }
}
