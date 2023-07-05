<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D11;

final class StepCounter
{
    public static function count(HexDirection ...$directions): int
    {
        $path = Path::ofDirections(...$directions);

        foreach (HexDirection::cases() as $direction) {
            $path = $path->reduceOpposites($direction);
        }

        foreach (HexDirection::shortcuts() as $direction => $shortcut) {
            $path = $path->reduceShortcuts($direction, ...$shortcut);
        }

        return $path->sum();
    }
}
