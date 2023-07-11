<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D09;

final readonly class Game
{
    public static function of(int $players): self
    {
        return new self($players);
    }

    private function __construct(private int $players)
    {
    }

    public function play(int $lastMarble): int
    {
        $i = 2;
        $circle = [1, 0];
        $players = array_fill(0, $this->players, 0);

        while ($i <= $lastMarble) {
            if ($i % 23) {
                $circle = [$i, ...array_slice($circle, 2), ...array_slice($circle, 0, 2)];
            } else {
                $players[$i % count($players)] += $circle[count($circle) - 7] + $i;
                $circle = [...array_slice($circle, -6), ...array_slice($circle, 0, -7)];
            }
            $i++;
        }

        return max($players);
    }
}
