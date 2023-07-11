<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D02;

use loophp\collection\Collection;

final readonly class Boxes
{
    public static function of(Id ...$ids): self
    {
        return new self($ids);
    }

    private function __construct(private array $ids)
    {
    }

    public function count(int $n): int
    {
        return Collection::fromIterable($this->ids)
            ->filter(static fn (Id $id) => $id->hasExactlyNumberOfAnyLetter($n))
            ->count();
    }
}
