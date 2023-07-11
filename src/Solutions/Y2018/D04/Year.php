<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D04;

use loophp\collection\Collection;

final readonly class Year
{
    public static function of(Night ...$nights): self
    {
        return new self($nights);
    }

    private function __construct(/** @var Night[] */ public array $nights)
    {
    }

    public function guardHistory(): iterable
    {
        return Collection::fromIterable($this->nights)
            ->groupBy(static fn (Night $night) => $night->guardId)
            ->map(static fn (iterable $nights) => GuardHistory::of(...$nights));
    }
}
