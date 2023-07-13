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

    public static function of(Map $map, Unit ...$units): self
    {
        return new self($map, $units);
    }

    private function __construct(public Map $map, /** @var Unit[] */ private array $units)
    {
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
        $factionCount = Collection::fromIterable($this->units())
            ->map(static fn (Unit $unit) => $unit->faction->value)
            ->distinct()
            ->count();
        return $factionCount > 1;
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

    public function countRounds(): int
    {
        return $this->rounds;
    }

    public function roundComplete(): bool
    {
        return $this->position === count($this->units);
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
