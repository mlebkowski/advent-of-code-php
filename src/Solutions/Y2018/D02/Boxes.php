<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D02;

use IteratorAggregate;
use loophp\collection\Collection;
use Traversable;

final readonly class Boxes implements IteratorAggregate
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

    public function withoutNthLetter(int $idx): self
    {
        return self::of(
            ...
            Collection::fromIterable($this->ids)
                ->map(static fn (Id $id) => $id->withoutNthLetter($idx))
                ->all(),
        );
    }

    public function getIterator(): Traversable
    {
        return Collection::fromIterable($this->ids)
            ->map(static fn (Id $id) => $id->value);
    }
}
