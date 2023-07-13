<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D13;

use App\Realms\Ansi\Ansi;
use App\Realms\Cartography\Map;
use App\Realms\Cartography\Point;

final readonly class CrashSiteMarker
{
    public static function markCrashSite(Point $position): void
    {
        $count = 3;
        $site = Map::ofPoints(['•'], 1);
        for ($i = 0; $i < $count; $i++) {
            $site = $site->framed();
        }

        $r = 0;
        while ($r++ < $count) {
            $rx = min($r, $position->x);
            $ry = min($r, $position->y);
            $diff = $count - $r;
            $diffX = $count - $rx;
            $diffY = $count - $ry;
            $x = $position->x - $rx;
            $y = $position->y - $ry;
            $lines = array_slice(explode("\n", (string)$site), $diffY, -$diff);
            foreach ($lines as $yOffset => $row) {
                echo Ansi::at($x, $y + $yOffset, Ansi::red(mb_substr($row, $diffX, -$diff)));
            }
            usleep(100_000);
        }
    }
}
