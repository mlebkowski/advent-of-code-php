<?php
declare(strict_types=1);

namespace App\Aoc\Parser;

use Closure;
use loophp\collection\Collection;
use loophp\collection\Operation\FlatMap;
use loophp\collection\Operation\Map;
use RuntimeException;

final readonly class Matcher
{
    public static function of(LinePattern ...$linePatterns): self
    {
        return new self($linePatterns);
    }

    public static function simple(string $pattern, Closure $factory): self
    {
        return self::of(LinePattern::withoutPrefix($pattern, $factory));
    }

    private function __construct(/** @var LinePattern[] */ private array $linePatterns)
    {
    }

    public function matchLines(string $iput, int $skip = 0, string $delim = "\n", bool $flatten = false): array
    {
        $op = false === $flatten ? Map::of() : FlatMap::of();
        return Collection::fromIterable(explode($delim, trim($iput)))
            ->slice($skip)
            ->pipe($op($this))
            ->all();
    }

    public function __invoke(string $line): mixed
    {
        $line = trim($line);
        foreach ($this->linePatterns as $linePattern) {
            if (false === $linePattern->matches($line)) {
                continue;
            }

            return $linePattern->create($line);
        }

        throw new RuntimeException("Unable to parse: $line");
    }
}
