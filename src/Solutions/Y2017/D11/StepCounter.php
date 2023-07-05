<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D11;

use Generator;

final class StepCounter
{
    public static function count(HexDirection ...$directions): Generator
    {
        $path = Path::empty();
        foreach ($directions as $dir) {
            $path = $path->add($dir);
            foreach (HexDirection::cases() as $direction) {
                $path = $path->reduceOpposites($direction);
            }

            foreach (HexDirection::shortcuts() as $direction => $shortcut) {
                $path = $path->reduceShortcuts($direction, ...$shortcut);
            }
            yield $path->sum();
        }

        return $path->sum();
    }
}
