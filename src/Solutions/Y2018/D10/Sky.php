<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D10;

use App\Realms\Ansi\Ansi;
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

    public function animate(): Generator
    {
        $stars = Collection::fromIterable($this->stars);
        $toPoints = static fn (Star $star) => Point::of($star->position->x, $star->position->y);
        $advance = static fn (Star $star) => $star->move();
        $advanceBy = static fn (float $by) => static fn (Star $star) => $star->move((int)$by);
        $toGlyphs = static fn (Point $point) => [$point, Ansi::yellow('*')];

        // region advance until stars are roughly together
        $targetSize = 4 * sqrt(count($this->stars));
        $area = Area::covering(...$stars->map($toPoints));
        while ($area->width() > $targetSize) {
            $stars = $stars->map($advanceBy((int)sqrt($area->width() - $targetSize)));
            $area = Area::covering(...$stars->map($toPoints));
        }
        // endregion

        $inArea = static fn (Point $point) => $area->contains($point);
        $starsInArea = static fn (Collection $stars) => $stars->map($toPoints)->filter($inArea)->isNotEmpty();

        // region now go back a little
        while ($starsInArea($stars)) {
            $stars = $stars->map($advanceBy(-3));
        }
        // endregion

        $normalize = static fn (Point $point) => $point->offset($area->minCorner);
        $map = Map::empty($area->width() + 1, $area->height() + 1);

        $minSteps = 10;
        $textArea = $area;
        $result = $map;
        while ($minSteps-- > 0 || $starsInArea($stars)) {
            $points = $stars
                ->map($toPoints)
                ->filter($inArea)
                ->map($normalize);

            $currentMap = $map->overlayPoints($points->map($toGlyphs));
            $currentArea = $points->count() === $stars->count() ? Area::covering(...$points) : $area;
            if ($currentArea->width() < $textArea->width() || $currentArea->height() < $textArea->height()) {
                $textArea = $currentArea;
                $result = $currentMap->cutOut($textArea);
            }

            yield $currentMap;
            $stars = $stars->map($advance);
        }
        yield $map;

        return $result->framed();
    }

}
