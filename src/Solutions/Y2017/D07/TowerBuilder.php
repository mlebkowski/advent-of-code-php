<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D07;

use loophp\collection\Collection;

final class TowerBuilder
{
    public static function buildFromShouts(Shout ...$shouts): Tower
    {
        $byProgramName = Collection::fromIterable($shouts)
            ->map(static fn (Shout $shout) => [$shout->program->name, $shout])
            ->unpack()
            ->all(false);

        $root = $byProgramName;
        foreach ($shouts as $shout) {
            foreach ($shout->above as $name) {
                unset($root[$name]);
            }
        }

        return self::buildFromRoot($byProgramName[key($root)], $byProgramName);
    }

    private static function buildFromRoot(Shout $item, array $shouts): Tower|Program
    {
        if ($item->isTopmost()) {
            return $item->program;
        }

        return Tower::of(
            $item->program,
            ...array_map(
                static fn (string $name) => self::buildFromRoot($shouts[$name], $shouts),
                $item->above,
            ),
        );
    }
}
