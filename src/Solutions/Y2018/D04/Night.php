<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D04;

use DateTimeImmutable;
use loophp\collection\Collection;

final readonly class Night
{
    public static function of(int $guardId, DateTimeImmutable $date, Sleep ...$sleeps): self
    {
        return new self($guardId, $date->modify("+1 hour"), $sleeps);
    }

    private function __construct(
        public int $guardId,
        public DateTimeImmutable $date,
        /** @var Sleep[] */
        public array $sleeps,
    ) {
    }

    public function minutesAsleep(): int
    {
        return Collection::fromIterable($this->sleeps)
            ->reduce(static fn (int $sum, Sleep $sleep) => $sum + $sleep->length(), 0);
    }
}
