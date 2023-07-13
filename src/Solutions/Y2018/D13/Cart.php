<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D13;

use App\Realms\Cartography\BoxDrawing\Line;
use App\Realms\Cartography\Orientation;
use App\Realms\Cartography\Point;

final readonly class Cart
{
    public static function of(Point $position, Orientation $direction): self
    {
        return new self($position, $direction, TurnPreference::initial(), collides: true);
    }

    private function __construct(
        public Point $position,
        public Orientation $orientation,
        public TurnPreference $turnPreference,
        private bool $collides,
    ) {
    }

    public function collidesWith(self $other): bool
    {
        if ($other === $this) {
            return false;
        }
        if ($other->isGhost() || $this->isGhost()) {
            return false;
        }
        return $other->position->equals($this->position);
    }

    public function ghost(): self
    {
        return new self(
            $this->position,
            $this->orientation,
            $this->turnPreference,
            collides: false,
        );
    }

    public function isGhost(): bool
    {
        return false === $this->collides;
    }

    public function move(string $gridChar): self
    {
        $orientation = $this->orientation;
        $turnPreference = $this->turnPreference;

        switch ($gridChar) {
            case Line::Intersection->value:
                $orientation = $turnPreference->getDirection($orientation);
                $turnPreference = $turnPreference->next();
                break;
            default:
                $orientation = Line::from($gridChar)->followDirection($orientation);
        }

        return new self(
            $this->position->inDirection($orientation),
            $orientation,
            $turnPreference,
            $this->collides,
        );
    }
}
