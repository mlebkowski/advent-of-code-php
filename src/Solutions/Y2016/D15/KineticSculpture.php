<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D15;

use loophp\collection\Collection;
use Stringable;

final readonly class KineticSculpture implements Stringable
{
    public static function of(Disc ...$discs): self
    {
        return new self($discs, time: 0);
    }

    private function __construct(private array $discs, public int $time)
    {
    }

    public function advance(): self
    {
        return new self(
            Collection::fromIterable($this->discs)
                ->map(static fn (Disc $disc) => $disc->rotate())
                ->all(),
            $this->time + 1,
        );
    }

    public function fallsInPlace(): bool
    {
        return Collection::fromIterable($this->discs)
            ->every(static fn (Disc $disc) => $disc->isAligned());
    }

    public function __toString(): string
    {
        return implode(" / ", $this->discs);
    }
}
