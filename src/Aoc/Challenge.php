<?php

declare(strict_types=1);

namespace App\Aoc;

use Stringable;

enum Part: int
{
    case One = 1;
    case Two = 2;
}

final readonly class Challenge implements Stringable
{
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

    public function __construct(public int $year, public int $day, public Part $part)
    {
        assert(in_array($year, range(2015, 2022), true));
        assert(in_array($day, range(1, 31), true));
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

    public function __toString(): string
    {
        return sprintf('year %d, day %d, part %s', $this->year, $this->day, $this->part->name);
    }
}
