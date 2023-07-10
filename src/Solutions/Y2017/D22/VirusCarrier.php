<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D22;

use App\Realms\Cartography\Orientation;
use App\Realms\Cartography\Point;
use App\Realms\Cartography\Turn;

final class VirusCarrier
{
    public bool $useEvolvedStrategy = false;

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
        $this->direction = match ($currentState) {
            InfectionState::Infected => $this->direction->turn(Turn::Right),
            InfectionState::Clean => $this->direction->turn(Turn::Left),
            InfectionState::Weakened => $this->direction,
            InfectionState::Flagged => $this->direction->opposite(),
        };

        match ($currentState) {
            InfectionState::Clean => match ($this->useEvolvedStrategy) {
                false => $this->cluster->infect($this->position),
                true => $this->cluster->weaken($this->position),
            },
            InfectionState::Infected => match ($this->useEvolvedStrategy) {
                false => $this->cluster->clean($this->position),
                true => $this->cluster->flag($this->position),
            },
            InfectionState::Weakened => $this->cluster->infect($this->position),
            InfectionState::Flagged => $this->cluster->clean($this->position),
        };
        $this->position = $this->position->inDirection($this->direction);
    }
}
