<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D04;

use loophp\collection\Collection;
use loophp\collection\Contract\Operation\Sortable;

final readonly class GuardHistory
{
    public static function of(Night ...$nights): self
    {
        $guardId = Collection::fromIterable($nights)
            ->map(static fn (Night $night) => $night->guardId)
            ->first();
        return new self($guardId, $nights);
    }

    public static function sortMostMinutesAsleep(self $alpha, self $bravo): int
    {
        return $bravo->minutesAsleep() <=> $alpha->minutesAsleep();
    }

    public static function sortMostTimesAsleepDuringSameMinute(self $alpha, self $bravo): int
    {
        return $bravo->mostNumberOfSleepsOnAGivenMinute() <=> $alpha->mostNumberOfSleepsOnAGivenMinute();
    }

    private function __construct(public int $guardId, private array $nights)
    {
    }

    public function minutesAsleep(): int
    {
        return Collection::fromIterable($this->nights)
            ->reduce(static fn (int $sum, Night $night) => $sum + $night->minutesAsleep(), 0);
    }

    public function mostCommonMinute(): int
    {
        return Collection::fromIterable($this->nights)
            ->flatMap(static fn (Night $night) => $night->sleeps)
            ->flatMap(static fn (Sleep $sleep) => range($sleep->start, $sleep->end - 1))
            ->frequency()
            ->sort(Sortable::BY_KEYS)
            ->last();
    }

    public function mostNumberOfSleepsOnAGivenMinute(): int
    {
        return Collection::fromIterable($this->nights)
            ->flatMap(static fn (Night $night) => $night->sleeps)
            ->flatMap(static fn (Sleep $sleep) => range($sleep->start, $sleep->end - 1))
            ->frequency()
            ->sort(Sortable::BY_KEYS)
            ->keys()
            ->last()
            ?? 0;
    }
}
