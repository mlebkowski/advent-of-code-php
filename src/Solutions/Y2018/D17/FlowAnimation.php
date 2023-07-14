<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D17;

use App\Lib\Type\Cast;
use App\Realms\Ansi\Ansi;
use App\Realms\Cartography\Area;
use App\Realms\Cartography\Map;
use App\Realms\Cartography\Point;

final class FlowAnimation
{
    public static function animate(Point $start, Map $map): Water
    {
        [$screenHeight, $screenWidth] = array_map(Cast::toInt(...), explode(' ', shell_exec("stty size")));
        --$screenHeight;

        echo Ansi::clearScren(), Ansi::hideCursor();
        $scrollTrigger = $screenHeight * 3 / 4;
        $pageScroll = intdiv($screenHeight, 2);
        $offset = 0;

        $flow = Stream::of($map, $start);
        foreach ($flow as $type => $point) {
            $y = $point->y - $offset;
            if ($y > $scrollTrigger || $point->y === 0) {
                echo Ansi::moveDown($pageScroll);
                $offset = min($point->y, $offset + $pageScroll);
                $area = Area::covering(
                    Point::of(0, $offset),
                    Point::of(
                        min(0 + $screenWidth, $map->width - 1),
                        min($offset + $screenHeight, $map->height - 1),
                    ),
                );
                $cutOut = $map->cutOut($area);
                $padding = $screenHeight > $cutOut->height
                    ? str_repeat("\n", $screenHeight - $cutOut->height + 1)
                    : '';
                echo $cutOut->withBoxDrawing(), $padding, Ansi::moveUp($screenHeight), Ansi::moveLeft($map->width);
            }

            $water = Ansi::blueBg($type ?: ' ');
            $map = $map->overlayPoints([[$point, $water]]);
            if ($point->y >= $offset) {
                echo Ansi::at($point->x, $point->y - $offset, $water);
            }
        }
        echo Ansi::moveDown(min($screenHeight, $map->height) + 3) . Ansi::showCursor();

        return $flow->getReturn();
    }
}
