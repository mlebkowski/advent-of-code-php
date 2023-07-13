<?php
declare(strict_types=1);

namespace App\Aoc\Parser;

use App\Lib\Type\Cast;
use Closure;

final readonly class ReMatcher
{
    public static function of(string $pattern, Closure $factory): self
    {
        preg_match_all('/%(\w)/', $pattern, $types);
        $casts = array_map(
            static fn (string $type) => match ($type) {
                'd' => Cast::toInt(...),
                default => Cast::identity(...),
            },
            end($types),
        );
        $pattern = preg_quote($pattern, '/');
        $pattern = strtr(
            $pattern,
            [
                '%d' => '(\d+)',
                '%w' => '(\w+)',
                '%s' => '(.+?)',
            ],
        );
        return new self("/$pattern/", $casts, $factory);
    }

    private function __construct(private string $pattern, private array $casts, private Closure $factory)
    {
    }

    public function match(string $input): array
    {
        preg_match_all($this->pattern, $input, $matches, PREG_SET_ORDER);

        return array_map($this->create(...), $matches);
    }

    private function create(array $match): mixed
    {
        $values = array_map(
            $this->cast(...),
            array_slice($match, 1),
            range(0, count($match) - 2),
        );

        return ($this->factory)(...$values);
    }

    private function cast(string $value, int $index): mixed
    {
        return ($this->casts[$index])($value);
    }
}
