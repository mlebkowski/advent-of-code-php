<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D05;

use loophp\collection\Collection;

final class ProblematicUnitFinder
{
    public static function of(string $polymer): iterable
    {
        return Collection::fromString($polymer)
            ->frequency()
            ->map(static fn (string $letter) => strtolower($letter))
            ->distinct()
            ->map(static fn (string $unit) => PolymerReaction::trigger(strtr(
                $polymer,
                [
                    $unit => '',
                    ucfirst($unit) => '',
                ],
            )));
    }
}
