<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D18;

use App\Aoc\Progress;
use loophp\collection\Collection;

final readonly class LightMatrix
{
    public static function ofLights(bool ...$lights): self
    {
        $sideLength = sqrt(count($lights));
        assert($sideLength === floor($sideLength));
        return new self(
            (int)$sideLength,
            Collection::fromIterable($lights)
                ->map(static fn (bool $state, int $idx) => Light::of(
                    state: $state,
                    point: Point::of(
                        x: $idx % $sideLength,
                        y: (int)floor($idx / $sideLength),
                    ),
                ))
                ->all(false),
        );
    }

    private function __construct(private int $sideLength, private array $lights)
    {
        assert(count($this->lights) === $this->sideLength ** 2);
    }

    public function update(Progress $progress): self
    {
        return self::ofLights(
            ...
            Collection::fromIterable($this->lights)
                ->apply($progress->step(...))
                ->map(fn (Light $light) => $light->update($this))
                ->apply($progress->report(...))
                ->map(static fn (Light $light) => $light->on)
                ->all(),
        );
    }

    public function countAdjacentLights(Point $point): int
    {
        $count = 0;
        foreach ($point->adjacent() as $adjacentPoint) {
            if ($this->at($adjacentPoint)?->on) {
                $count++;
            }
        }
        return $count;
    }

    public function countLightsOn(): int
    {
        return Collection::fromIterable($this->lights)
            ->filter(static fn (Light $light) => $light->on)
            ->count();
    }

    public function count(): int
    {
        return count($this->lights);
    }

    public function at(Point $point): Light|null
    {
        if ($point->x >= $this->sideLength || $point->y >= $this->sideLength) {
            return null;
        }

        return $this->lights[$point->x + $point->y * $this->sideLength] ?? null;
    }
}
