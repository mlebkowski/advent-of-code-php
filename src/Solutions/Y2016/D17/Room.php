<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D17;

use loophp\collection\Collection;

final readonly class Room
{
    public static function traverseOpenDoors(Path $path, Environment $environment): iterable
    {
        $hash = md5($environment->passcode . $path);
        return Collection::fromIterable(Direction::cases())
            ->map(
                static fn (Direction $direction, int $idx) => Door::of(
                    $direction,
                    Lock::fromString($hash[$idx]),
                ),
            )
            ->reject(static fn (Door $door) => $path->leadsOutsideGrid($door, $environment))
            ->filter(static fn (Door $door) => $door->allowsPassage())
            ->map(static fn (Door $door) => $path->go($door->direction))
            ->all();
    }
}
