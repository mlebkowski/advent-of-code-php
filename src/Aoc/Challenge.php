<?php

declare(strict_types=1);

namespace App\Aoc;

use loophp\collection\Collection;
use Stringable;

final readonly class Challenge implements Stringable
{
    private const LastDay = 25;

    public static function fromArgv(array $argv): self
    {
        return new self((int)$argv[1], (int)$argv[2], Part::from((int)$argv[3]));
    }

    public static function bothParts(int $year, int $day): iterable
    {
        return [
            self::of($year, $day, Part::One),
            self::of($year, $day, Part::Two),
        ];
    }

    public static function of(int $year, int $day, Part $part): self
    {
        return new self($year, $day, $part);
    }

    public static function mostRecent(self $alpha, self $bravo): int
    {
        return $alpha->year <=> $bravo->year ?: $alpha->day <=> $bravo->day;
    }

    public function __construct(public int $year, public int $day, public Part $part)
    {
        assert(in_array($year, range(2015, 2022), true));
        assert(in_array($day, range(1, 31), true));
    }

    public function isSolvedBy(Solution $solution): bool
    {
        return Collection::fromIterable($solution->challenges())
            ->filter(fn (Challenge $challenge) => $challenge->equals($this))
            ->isNotEmpty();
    }

    public function isPartOne(): bool
    {
        return Part::One === $this->part;
    }

    public function isPartTwo(): bool
    {
        return Part::Two === $this->part;
    }

    public function equals(Challenge $other): bool
    {
        return $other->year === $this->year
            && $other->day === $this->day
            && $other->part === $this->part;
    }

    public function next(): Challenge
    {
        if ($this->day === self::LastDay) {
            return self::of($this->year + 1, 1, Part::One);
        }
        return self::of($this->year, $this->day + 1, Part::One);
    }

    public function __toString(): string
    {
        return sprintf('year %d, day %d, part %s', $this->year, $this->day, $this->part->name);
    }
}
