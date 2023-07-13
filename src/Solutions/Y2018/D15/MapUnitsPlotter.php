<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D15;

use App\Realms\Ansi\Ansi;
use App\Realms\Ansi\Background;
use App\Realms\Ansi\Foreground;
use App\Realms\Cartography\Map;
use loophp\collection\Collection;

final readonly class MapUnitsPlotter
{
    private string $elves;
    private string $goblins;
    private string $block;

    public static function of(Map $map): self
    {
        return new self($map);
    }

    private function __construct(private Map $map)
    {
        $this->elves = Ansi::color('•', foreground: Foreground::Green, background: Background::Grey);
        $this->goblins = Ansi::color('•', foreground: Foreground::Red, background: Background::Grey);
        $this->block = Ansi::color(' ', background: Background::Grey);
    }

    public function plot(Battleground $battleground): Map
    {
        $units = Collection::fromIterable($battleground->units())
            ->map(fn (Unit $unit) => [
                $unit->position,
                match ($unit->faction) {
                    Faction::Elves => $this->elves,
                    Faction::Goblins => $this->goblins,
                },
            ]);

        return $this->map->overlayPoints($units)->apply(
            fn (string $point) => match ($point) {
                '#' => ' ',
                ' ' => $this->block,
                default => $point,
            },
        );
    }
}
