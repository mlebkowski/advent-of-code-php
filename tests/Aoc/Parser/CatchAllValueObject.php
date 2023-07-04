<?php
declare(strict_types=1);

namespace App\Aoc\Parser;

use Closure;

final readonly class CatchAllValueObject
{
    public static function of(mixed ...$arguments): self
    {
        return new self($arguments);
    }

    public static function named(string $name): Closure
    {
        return static fn (mixed ...$arguments) => self::of($name, ...$arguments);
    }

    public static function extractArguments(self ...$items): array
    {
        return array_map(static fn (self $vo) => $vo->arguments, $items);
    }

    private function __construct(public array $arguments)
    {
    }
}
