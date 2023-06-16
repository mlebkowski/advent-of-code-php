<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D18;

use Stringable;

final readonly class Light implements Stringable
{
    public const On = '#';
    public const Off = '.';

    public static function of(bool $state, Point $point): self
    {
        return new self($state, $point);
    }

    private function __construct(public bool $on, public Point $point)
    {
    }

    public function update(LightMatrix $matrix): self
    {
        $adjacentLights = $matrix->countAdjacentLights($this->point);
        $nextState = match (true) {
            $this->on => in_array($adjacentLights, [2, 3], true),
            default => $adjacentLights === 3,
        };

        return Light::of($nextState, $this->point);
    }

    public function __toString(): string
    {
        return $this->on ? self::On : self::Off;
    }

}
