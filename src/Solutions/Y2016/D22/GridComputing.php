<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D22;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Realms\Cartography\Map;
use App\Realms\Cartography\Orientation;
use App\Realms\Cartography\PathFinding;
use App\Realms\Cartography\Point;
use loophp\collection\Collection;

/**
 * @implements Solution<GridComputingInput>
 * @see file://var/2016-22.txt
 * @see file://var/2016-22-1-sample.txt
 * @see file://var/2016-22-1-expected.txt
 * @see file://var/2016-22-2-sample.txt
 * @see file://var/2016-22-2-expected.txt
 */
final class GridComputing implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2016, 22);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $nodes = Collection::fromIterable($input->nodes);

        if ($challenge->isPartOne()) {
            return $nodes
                ->product($nodes)
                ->unpack()
                ->filter(Node::isViablePair(...))
                ->count();
        }

        $average = $nodes
            ->map(static fn (Node $node) => $node->size)
            ->averages()
            ->last();

        $width = 1 + $nodes
            ->map(static fn (Node $node) => $node->point->x)
            ->max();

        $points = $nodes->sort(callback: Node::sortForGrid(...));

        $dataNodeCoords = Point::of($width - 1, 0);
        $accessNodeCoords = Point::center();

        $pointsForMap = $points
            ->map(static fn (Node $node) => match (true) {
                $node->isEmpty() => '_',
                $node->size > $average => '#',
                $node->point->equals($dataNodeCoords) => 'G',
                $node->point->equals($accessNodeCoords) => '@',
                default => '.',
            })
            ->all();

        $pointsForPathFinding = $points
            ->map(static fn (Node $node) => $node->size > $average)
            ->all();

        $emptyNode = $points->find(callbacks: static fn (Node $node) => $node->isEmpty());

        $pathFinding = PathFinding::of($pointsForPathFinding, $width);

        $target = $dataNodeCoords->inDirection(Orientation::West);
        $path = $pathFinding->getPath($emptyNode->point, $target);

        $map = Map::ofPoints($pointsForMap, $width)->overlayPath($path);

        echo "\n", $map, "\n\n";

        return $path->steps() + 1 + 5 * ($width - 2);
    }
}
