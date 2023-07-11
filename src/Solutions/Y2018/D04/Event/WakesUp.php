<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D04\Event;

use DateTimeImmutable;

final readonly class WakesUp implements Event
{
    public static function of(DateTimeImmutable $on): self
    {
        return new self($on);
    }

    private function __construct(public DateTimeImmutable $on)
    {
    }

    public function timestamp(): DateTimeImmutable
    {
        return $this->on;
    }

    public function __toString(): string
    {
        return sprintf("[%s] wakes up", $this->on->format('Y-m-d H:i'));
    }
}
