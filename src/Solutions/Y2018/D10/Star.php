<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D10;

use App\Realms\Physics\Vector;
use Stringable;

final readonly class Star implements Stringable
{
    public static function of(Vector $position, Vector $velocity): self
    {
        return new self($position, $velocity);
    }

    private function __construct(public Vector $position, public Vector $velocity)
    {
    }

    public function move(int $count = 1): self
    {
        return new self(
            Vector::of(
                $this->position->x + $this->velocity->x * $count,
                $this->position->y + $this->velocity->y * $count,
            ),
            $this->velocity,
        );
    }

    public function __toString(): string
    {
        return "position=$this->position velocity=$this->velocity";
    }
}
