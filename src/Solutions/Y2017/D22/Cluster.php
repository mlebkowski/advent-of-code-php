<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D22;

use App\Realms\Cartography\Map;
use App\Realms\Cartography\Point;

final class Cluster
{
    private int $infectionCount = 0;

    public static function ofMap(Map $map): self
    {
        return new self(
            $map->withCoordinates()
                ->map(static fn (string $state, Point $point) => [
                    (string)$point,
                    InfectionState::from($state),
                ])
                ->unpack()
                ->all(false),
        );
    }

    private function __construct(private array $nodes)
    {
    }

    public function infectionCount(): int
    {
        return $this->infectionCount;
    }

    public function stateAt(Point $point): InfectionState
    {
        return $this->nodes[(string)$point] ?? InfectionState::Clean;
    }

    public function infect(Point $point): void
    {
        $this->infectionCount++;
        $this->nodes[(string)$point] = InfectionState::Infected;
    }

    public function clean(Point $point): void
    {
        $this->nodes[(string)$point] = InfectionState::Clean;
    }

    public function weaken(Point $point): void
    {
        $this->nodes[(string)$point] = InfectionState::Weakened;
    }

    public function flag(Point $point): void
    {
        $this->nodes[(string)$point] = InfectionState::Flagged;
    }
}
