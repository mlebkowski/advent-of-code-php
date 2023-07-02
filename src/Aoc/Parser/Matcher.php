<?php
declare(strict_types=1);

namespace App\Aoc\Parser;

use RuntimeException;

final class Matcher
{
    private array $prefixes = [];

    public static function create(): self
    {
        return new self();
    }

    private function __construct()
    {
    }

    public function startsWith(string $prefix, string $pattern, callable $factory): self
    {
        $this->prefixes[trim($prefix)] = [$pattern, $factory];
        return $this;
    }

    public function parse(string $line): mixed
    {
        $line = trim($line);
        foreach ($this->prefixes as $prefix => [$pattern, $factory]) {
            if (false === str_starts_with($line, $prefix)) {
                continue;
            }

            $data = trim(substr($line, strlen($prefix)));
            $payload = sscanf($data, $pattern);
            return $factory(...$payload);
        }

        throw new RuntimeException("Unable to parse: $line");
    }
}
