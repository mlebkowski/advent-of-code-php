<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D17;

use App\Solutions\Y2016\D17\Problems\GotLost;
use loophp\collection\Collection;

final readonly class Journey
{
    /**
     * @throws GotLost
     */
    public static function shortestPathToVault(Environment $environment): Path
    {
        $paths = [Path::empty()];

        while (true) {
            $paths = Collection::fromIterable($paths)
                ->flatMap(static fn (Path $path) => Room::traverseOpenDoors($path, $environment))
                ->squash();

            GotLost::whenNoAvailablePaths($paths->count());

            $toVault = $paths->find(
                callbacks: static fn (Path $path) => $path->isVault($environment),
            );

            if ($toVault) {
                return $toVault;
            }
        }
    }

    public static function longestPathToVaultLength(Environment $environment): int
    {
        $paths = [Path::empty()];
        $maxLength = 0;

        while (true) {
            [$toVault, $paths] = Collection::fromIterable($paths)
                ->flatMap(static fn (Path $path) => Room::traverseOpenDoors($path, $environment))
                ->partition(static fn (Path $path) => $path->isVault($environment))
                ->all();

            $localMax = $toVault->map(static fn (Path $path) => $path->length())->max();

            $maxLength = max($localMax, $maxLength);
            if ($paths->isEmpty()) {
                return $maxLength;
            }
        }
    }
}
