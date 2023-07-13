<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D15;

use App\Realms\Cartography\Map;
use App\Realms\Cartography\PathFinding;
use loophp\collection\Collection;

final class Battleground
{
    private int $position = 0;
    private int $rounds = 0;
    private readonly int $startingElfCount;

    public static function of(Map $map, int $elfAttack, Unit ...$units): self
    {
        return new self($map, $elfAttack, $units);
    }

    private function __construct(
        public readonly Map $map,
        public readonly int $elfAttack,
        private array $units,
    ) {
        $this->startingElfCount = $this->elfCount();
    }

    public function units(): array
    {
        return Collection::fromIterable($this->units)
            ->reject(static fn (Unit $unit) => $unit->isDead())
            ->all();
    }

    public function enemies(Unit $unit): array
    {
        return Collection::fromIterable($this->units())
            ->filter(static fn (Unit $other) => $unit->isEnemy($other))
            ->all();
    }

    public function battleContinues(): bool
    {
        if ($this->elfAttack > 3 && $this->hasElfCasualties()) {
            // break the sim as soon as we have casualties, save time
            return false;
        }

        $factionCount = Collection::fromIterable($this->units())
            ->map(static fn (Unit $unit) => $unit->faction->value)
            ->distinct()
            ->count();
        return $factionCount > 1;
    }

    public function hasElfCasualties(): bool
    {
        return $this->elfCount() < $this->startingElfCount;
    }

    public function outcome(): int
    {
        $rounds = $this->rounds - 1;
        $hp = array_sum(array_map(static fn (Unit $unit) => $unit->hp(), $this->units()));
        return $hp * $rounds;
    }

    public function pathFinding(Unit $unit): PathFinding
    {
        $unitPoints = Collection::fromIterable($this->units())
            ->reject(static fn (Unit $other) => $other === $unit)
            ->map(static fn (Unit $unit) => [$unit->position, 'O'])
            ->all();

        return $this->map->overlayPoints($unitPoints)->toPathFinding('#', 'O');
    }

    public function current(): Unit
    {
        return $this->units[$this->position];
    }

    public function turn(): void
    {
        $this->current()->turn($this);
        $this->position++;

        while (false === $this->roundComplete() && $this->current()->isDead()) {
            $this->position++;
        }
    }

    public function nextRound(): void
    {
        assert($this->roundComplete());
        $this->rounds++;
        $this->cleanup();
    }

    public function roundComplete(): bool
    {
        return $this->position === count($this->units);
    }

    private function elfCount(): int
    {
        return count(array_filter($this->units(), Unit::isElf(...)));
    }

    private function cleanup(): void
    {
        $this->position = 0;
        $this->units = array_filter(
            $this->units,
            static fn (Unit $unit) => false === $unit->isDead(),
        );
        usort($this->units, ReadingOrder::sort(...));
    }
}
