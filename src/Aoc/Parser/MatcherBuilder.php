<?php
declare(strict_types=1);

namespace App\Aoc\Parser;

use Closure;

final class MatcherBuilder
{
    private array $patterns = [];

    public static function create(): self
    {
        return new self();
    }

    private function __construct()
    {
    }

    public function startsWith(string $prefix, string $pattern, Closure $factory): self
    {
        $this->patterns[] = LinePattern::of(trim($prefix), $pattern, $factory);
        return $this;
    }

    public function prefixed(string $prefix, Closure $factory): self
    {
        $this->patterns[] = LinePattern::of(trim($prefix), LinePattern::RestPattern, $factory);
        return $this;
    }

    public function getMatcher(): Matcher
    {
        return Matcher::of(...$this->patterns);
    }
}
