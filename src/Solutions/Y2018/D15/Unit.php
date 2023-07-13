<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D15;

use App\Realms\Cartography\Point;
use App\Solutions\Y2018\D15\Action\AttackTargetFactory;
use App\Solutions\Y2018\D15\Action\NextStepFactory;
use Stringable;

final class Unit implements Stringable
{
    public const Attack = 3;
    private int $hitPoints = 200;

    public static function of(Point $position, Faction $faction): self
    {
        return new self($position, $faction);
    }

    private function __construct(public Point $position, public readonly Faction $faction)
    {
    }

    public function hp(): int
    {
        return $this->hitPoints;
    }

    public function inRange(self $enemy): bool
    {
        return $enemy->position->distance($this->position)->manhattan === 1;
    }

    public function isEnemy(self $other): bool
    {
        return $this->faction !== $other->faction;
    }

    public function turn(Battleground $battleground): void
    {
        $this->position = NextStepFactory::create($this, $battleground);
        $target = AttackTargetFactory::make($this, $battleground);
        $target?->takeHit();
    }

    public function takeHit(): void
    {
        $this->hitPoints -= self::Attack;
    }

    public function isDead(): bool
    {
        return $this->hitPoints <= 0;
    }

    public function __toString(): string
    {
        $type = $this->faction->value;
        return "{$type}[$this->position]";
    }
}
