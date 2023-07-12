<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D09;

use App\Aoc\Progress\Progress;
use SplDoublyLinkedList;

final readonly class Game
{
    public static function of(int $players): self
    {
        return new self($players);
    }

    private function __construct(private int $players)
    {
    }

    public function play(int $lastMarble, Progress $progress = null): int
    {
        $i = 2;
        $circle = new SplDoublyLinkedList();
        $circle->unshift(0);
        $circle->unshift(1);
        $players = array_fill(0, $this->players, 0);
        while ($i <= $lastMarble) {
            $progress?->iterate($i);
            if ($i % 23) {
                $circle->push($circle->shift());
                $circle->push($circle->shift());
                $circle->unshift($i);
            } else {
                $circle->unshift($circle->pop());
                $circle->unshift($circle->pop());
                $circle->unshift($circle->pop());
                $circle->unshift($circle->pop());
                $circle->unshift($circle->pop());
                $circle->unshift($circle->pop());
                $removed = $circle->pop();
                $players[$i % count($players)] += $removed + $i;
            }
            $i++;
        }

        return max($players);
    }
}
