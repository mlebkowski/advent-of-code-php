<?php
declare(strict_types=1);

namespace App\Realms\Computing\Optimizer;

use App\Realms\Computing\Instruction\Instruction;

final readonly class PatternMatcher
{
    public static function of(string $pattern): self
    {
        preg_match_all('/:(?P<name>\w+)/', $pattern, $matches);
        $names = array_unique($matches['name']);
        $pattern = preg_quote($pattern, '/');
        foreach ($names as $name) {
            $pattern = preg_replace("/\\\\:$name/", "(?P<$name>\\w+)", $pattern, limit: 1);
            $pattern = str_replace("\\:$name", sprintf('\g{%s}', $name), $pattern);
        }
        return new self(sprintf('/^%s$/', $pattern), array_flip($names));
    }

    private function __construct(private string $pattern, private array $names)
    {
    }

    public function match(Instruction ...$instructions): array|false
    {
        $toAssembly = implode("\n", $instructions);

        preg_match(
            $this->pattern,
            $toAssembly,
            $matches,
        );

        return $matches ? array_intersect_key($matches, $this->names) : false;
    }
}
