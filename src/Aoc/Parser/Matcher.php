<?php
declare(strict_types=1);

namespace App\Aoc\Parser;

use Closure;
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

    public function matchLines(string $iput, int $skip = 0): array
    {
        return array_map($this, array_slice(explode("\n", trim($iput)), $skip));
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
