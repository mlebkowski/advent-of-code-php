<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D05;

use loophp\collection\Collection;

final readonly class PolymerReaction
{
    public static function trigger(string $polymer): string
    {
        $pairs = Collection::fromString($polymer)
            ->frequency()
            ->map(static fn (string $letter) => strtolower($letter))
            ->distinct()
            ->flatMap(static fn (string $letter) => [$letter . ucfirst($letter), ucfirst($letter) . $letter])
            ->flip()
            ->map(static fn () => '')
            ->all(false);

        while (true) {
            $result = strtr($polymer, $pairs);
            if ($result === $polymer) {
                return $result;
            }
            $polymer = $result;
        }
    }
}
