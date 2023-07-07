<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D14\Visualizer;

use App\Realms\Cartography\Area;
use App\Realms\Cartography\Map;
use App\Realms\Cartography\Path;
use App\Realms\Cartography\Point;
use App\Solutions\Y2017\D14\OrthogonallyConnectedGroupFinder;
use Generator;

final class GroupExpandingVisualizer
{
    private const HideCursor = "\033[?25l";
    private const RestoreCursor = "\033[?25h";
    private const HighlightColor = "\033[0;31m";
    private const RestoreColor = "\033[0m";

    public static function ofMap(Map $map, int $delay = 0): Generator
    {
        $height = $map->height + 2;
        $moveCursorToTop = "\n\033[{$height}A";
        $moveCursorToBottom = "\033[{$height}B\n";

        // pre-calculate to save some time for later:
        $frame = Path::aroundArea(
            Area::covering(Point::center(), $map->withCoordinates()->keys()->last()),
        )->toMap();
        $print = static function (Map $map) use ($frame, $moveCursorToTop, $delay) {
            usleep(2 * $delay);
            return $frame->overlay($map, Point::of(x: 1, y: 1))->withBoxDrawing() . $moveCursorToTop;
        };

        yield self::HideCursor . $print($map);

        $count = 0;
        while ($point = self::findRandomPoint($map)) {
            $count++;
            $group = OrthogonallyConnectedGroupFinder::find($map, $point);
            foreach ($group as $step) {
                $step = $step->apply(static fn (string $value) => match ($value) {
                    '#' => self::HighlightColor . "█" . self::RestoreColor,
                    default => $value,
                });
                $step = $map->overlay($step, Point::center());
                yield $print($step);
            }

            $final = $group
                ->getReturn()
                ->apply(static fn (string $value) => match ($value) {
                    '#' => '.',
                    default => $value,
                });

            $map = $map->overlay($final, Point::center());
            yield $print($map);
        }

        yield $moveCursorToBottom . self::RestoreCursor;
        return $count;
    }

    private static function findRandomPoint(Map $map): ?Point
    {
        return $map->withCoordinates()
            ->filter(static fn (string $value) => '#' === $value)
            ->keys()
            ->shuffle()
            ->first();
    }
}
