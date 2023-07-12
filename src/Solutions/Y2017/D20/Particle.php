<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D20;

use App\Realms\Physics\Vector;

final readonly class Particle
{
    public static function of(Vector $position, Vector $velocity, Vector $acceleration): self
    {
        return new self($position, $velocity, $acceleration);
    }

    public static function lowestAcceleration(self $alpha, self $bravo): int
    {
        return $alpha->acceleration->value() <=> $bravo->acceleration->value();
    }

    private function __construct(public Vector $position, public Vector $velocity, public Vector $acceleration)
    {
    }

    public function step(): self
    {
        $velocity = $this->velocity->add($this->acceleration);
        $position = $this->position->add($velocity);
        return self::of($position, $velocity, $this->acceleration);
    }
}
