<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D10;

use App\Realms\Ansi\Ansi;
use App\Realms\Ansi\Foreground;
use App\Realms\Ansi\Intensity;
use App\Realms\Cartography\Area;
use App\Realms\Cartography\Map;
use App\Realms\Cartography\Point;
use Generator;
use loophp\collection\Collection;

final readonly class Sky
{
    public static function ofStars(Star ...$stars): self
    {
        return new self($stars);
    }

    private function __construct(private array $stars)
    {
    }

    /** @return Generator<int,int,Map,Result> */
    public function animate(): Generator
    {
        $seconds = 0;

        $stars = Collection::fromIterable($this->stars);
        $toPoints = static fn (Star $star) => Point::of($star->position->x, $star->position->y);
        $advance = static fn (Star $star) => $star->move();
        $advanceBy = static fn (float $by) => static fn (Star $star) => $star->move((int)$by);
        $toGlyphs = static fn (Point $point) => [$point, Ansi::color('*', Foreground::Yellow, intensity: Intensity::Bold)];

        // region advance until stars are roughly together
        $targetSize = 4 * sqrt(count($this->stars));
        $area = Area::covering(...$stars->map($toPoints));
        while ($area->width() > $targetSize) {
            $by = (int)sqrt($area->width() - $targetSize);
            $seconds += $by;
            $stars = $stars->map($advanceBy($by));
            $area = Area::covering(...$stars->map($toPoints));
        }
        // endregion

        $inArea = static fn (Point $point) => $area->contains($point);
        $starsInArea = static fn (Collection $stars) => $stars->map($toPoints)->filter($inArea)->isNotEmpty();

        // region now go back a little
        while ($starsInArea($stars)) {
            $stars = $stars->map($advanceBy(-3));
            $seconds -= 3;
        }
        // endregion

        $normalize = static fn (Point $point) => $point->offset($area->minCorner);
        $map = Map::ofArea($area);

        $minSteps = 10;
        $textArea = $area;
        $result = Result::of($map, $seconds);
        while ($minSteps-- > 0 || $starsInArea($stars)) {
            $points = $stars
                ->map($toPoints)
                ->filter($inArea)
                ->map($normalize);

            $currentMap = $map->overlayPoints($points->map($toGlyphs));
            $currentArea = $points->count() === $stars->count() ? Area::covering(...$points) : $area;
            if ($currentArea->width() < $textArea->width() || $currentArea->height() < $textArea->height()) {
                $textArea = $currentArea;
                $result = Result::of($currentMap->cutOut($textArea)->framed(), $seconds);
            }

            yield $currentMap;
            $stars = $stars->map($advance);
            $seconds++;
        }
        yield $map;

        return $result;
    }
}
