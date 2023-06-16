<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D18;

use App\Aoc\Progress;
use loophp\collection\Collection;

final readonly class LightMatrix
{
    public static function ofLights(bool ...$lights): self
    {
        $side = sqrt(count($lights));
        assert($side === floor($side));

        return new self(
            Collection::fromIterable($lights)
                ->map(static fn (bool $state, int $idx) => Light::of(
                    state: $state,
                    point: Point::of(
                        x: $idx % $side,
                        y: (int)floor($idx / $side),
                    ),
                ))
                ->groupBy(static fn (Light $light) => $light->point->y)
                ->all(false),
        );
    }

    private function __construct(private array $lights)
    {
    }

    public function update(Progress $progress): self
    {
        return self::ofLights(
            ...
            Collection::fromIterable($this->lights)
                ->flatten()
                ->apply($progress->step(...))
                ->map(fn (Light $light) => $light->update($this))
                ->apply($progress->report(...))
                ->map(static fn (Light $light) => $light->on)
                ->all(),
        );
    }

    public function countAdjacentLights(Point $point): int
    {
        $light = $this->lights[$point->x][$point->y] ?? null;
        if (null === $light) {
            return 0;
        }

        $rectangle = Rectangle::covering(...$point->adjacent());
        return Collection::fromIterable($this->within($rectangle))
            ->filter(static fn (Light $light) => $light->on)
            ->filter(static fn (Light $light) => false === $light->point->equals($point))
            ->count();
    }

    public function countLightsOn(): int
    {
        return Collection::fromIterable($this->lights)
            ->flatten()
            ->filter(static fn (Light $light) => $light->on)
            ->count();
    }

    private function within(Rectangle $rectangle): iterable
    {
        return Collection::fromIterable($this->lights)
            ->flatten()
            ->filter(static fn (Light $light) => $rectangle->contains($light->point));
    }
}
