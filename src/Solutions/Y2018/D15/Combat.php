<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D15;

use App\Realms\Ansi\Ansi;

final class Combat
{
    public static function animate(Battleground $battleground): void
    {
        $height = $battleground->map->height;
        echo "\n\n", Ansi::hideCursor();

        $mapPlotter = MapUnitsPlotter::of($battleground->map);

        while ($battleground->battleContinues()) {
            while (false === $battleground->roundComplete()) {
                $battleground->turn();
                echo $mapPlotter->plot($battleground), "\n", Ansi::moveUp($height);
            }
            $battleground->nextRound();
        }

        echo Ansi::moveDown($height) . Ansi::showCursor(), "\n";
    }
}
