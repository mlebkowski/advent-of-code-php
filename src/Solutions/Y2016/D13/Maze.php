<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D13;

use loophp\collection\Collection;
use Stringable;

final readonly class Maze implements Stringable
{
    public static function ofMagicNumber(CoordinateBuilder $builder, int $width, int $height)
    {
        assert($width > 0 && $height > 0);
        $points = Collection::range(0, $width * $height)
            ->map($builder->fromIndex(...))
            ->all();
        return new self($points, $width);
    }

    private function __construct(private array $points, private int $width)
    {
    }

    public function __toString(): string
    {
        return "\n" . Collection::fromIterable($this->points)
            ->map(static fn (bool $state) => $state ? '█' : ' ')
            ->chunk($this->width)
            ->map(static fn (array $row) => implode('', $row))
            ->implode("\n");
    }
}
