<?php
declare(strict_types=1);

namespace App\Aoc\Parser;

use Closure;

final readonly class LinePattern
{
    public const RestPattern = '%...';
    public string $pattern;
    private bool $useRestOfLine;

    public static function of(string $prefix, string $pattern, Closure $factory): self
    {
        return new self($prefix, $pattern, $factory);
    }

    public static function withoutPrefix(string $pattern, Closure $factory): self
    {
        return self::of('', $pattern, $factory);
    }

    private function __construct(
        public string $prefix,
        string $pattern,
        public Closure $factory,
    ) {
        $useRestOfLine = false;
        if (str_ends_with($pattern, self::RestPattern)) {
            $pattern = substr($pattern, 0, -strlen(self::RestPattern)) . '%n';
            $useRestOfLine = true;
        }

        $this->pattern = $pattern;
        $this->useRestOfLine = $useRestOfLine;
    }

    public function matches(string $line): bool
    {
        return str_starts_with($line, $this->prefix);
    }

    public function create(string $line): mixed
    {
        $data = trim(substr($line, strlen($this->prefix)));
        $payload = $this->pattern ? sscanf($data, $this->pattern) : [$data];
        if ($this->useRestOfLine) {
            $offset = array_pop($payload);
            if (null !== $offset) {
                $payload[] = trim(substr($data, $offset));
            }
        }
        return ($this->factory)(...$payload);
    }
}
