<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D22;

use App\Realms\Cartography\Orientation;
use App\Realms\Cartography\Point;
use App\Realms\Cartography\Turn;

final class VirusCarrier
{
    public static function ofCluster(Cluster $cluster, Point $startingPoint): self
    {
        return new self($cluster, $startingPoint, Orientation::North);
    }

    private function __construct(
        private readonly Cluster $cluster,
        private Point $position,
        private Orientation $direction,
    ) {
    }

    public function burst(): void
    {
        $currentState = $this->cluster->stateAt($this->position);
        $turn = match ($currentState) {
            InfectionState::Infected => Turn::Right,
            InfectionState::Clean => Turn::Left,
        };
        $this->direction = $this->direction->turn($turn);
        match ($currentState) {
            InfectionState::Infected => $this->cluster->clean($this->position),
            InfectionState::Clean => $this->cluster->infect($this->position),
        };
        $this->position = $this->position->inDirection($this->direction);
    }
}
