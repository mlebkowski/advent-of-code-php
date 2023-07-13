<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D13\Events;

use App\Realms\Cartography\Point;
use Stringable;

final readonly class LastCartStanding implements Stringable
{
    public static function of(Point $position): self
    {
        return new self($position);
    }

    private function __construct(public Point $position)
    {
    }

    public function __toString(): string
    {
        return sprintf('%d,%d', $this->position->x, $this->position->y);
    }
}
