<?php
declare(strict_types=1);

namespace App\Realms\Ansi;

use App\Realms\Cartography\Map;
use Generator;

final class DisplayMapInIterations
{
    /**
     * @param Generator<int,int,Map> $mapGenerator
     */
    public static function display(Generator $mapGenerator, int $delay = 0): void
    {
        $height = 0;
        foreach ($mapGenerator as $map) {
            $height = $map->height;
            echo $map, "\n", Ansi::moveUp($height);
            usleep($delay);
        }

        echo Ansi::moveDown($height);
    }
}
