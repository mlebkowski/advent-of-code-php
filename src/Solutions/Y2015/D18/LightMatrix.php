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

    private function __construct(
        private int $sideLength,
        private array $lights,
        private array $stuckPoints = [],
    ) {
        assert(count($this->lights) === $this->sideLength ** 2);
    }

    public function update(Progress $progress): self
    {
        return new self(
            $this->sideLength,
            Collection::fromIterable($this->lights)
                ->apply($progress->step(...))
                ->map(fn (Light $light) => $light->update($this))
                ->apply($progress->report(...))
                ->all(),
            $this->stuckPoints,
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

    public function corners(): iterable
    {
        yield Point::of(0, 0);
        yield Point::of($this->sideLength - 1, 0);
        yield Point::of(0, $this->sideLength - 1);
        yield Point::of($this->sideLength - 1, $this->sideLength - 1);
    }

    public function withStuckPoints(Point ...$stuckPoints): self
    {
        return new self($this->sideLength, $this->lights, $stuckPoints);
    }

    public function isStuck(Point $point): bool
    {
        /** @var Point $point */
        foreach ($this->stuckPoints as $stuckPoint) {
            if ($point->equals($stuckPoint)) {
                return true;
            }
        }
        return false;
    }
}
