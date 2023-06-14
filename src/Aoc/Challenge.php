<?php

declare(strict_types=1);

namespace App\Aoc;

use Stringable;

final readonly class Challenge implements Stringable
{
    public static function fromArgv(array $argv): self
    {
        return new self(...array_map('intval', array_slice($argv, 1)));
    }

    public static function of(int $year, int $day, int $part): self
    {
        return new self($year, $day, $part);
    }

    public function __construct(public int $year, public int $day, public int $part)
    {
        assert(in_array($year, range(2015, 2022), true));
        assert(in_array($day, range(1, 31), true));
        assert(in_array($part, [1, 2], true));
    }

    public function equals(Challenge $other): bool
    {
        return $other->year === $this->year
            && $other->day === $this->day
            && $other->part === $this->part;
    }

    public function __toString(): string
    {
        return sprintf('year %d, day %d, part %d', $this->year, $this->day, $this->part);
    }
}
