<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D14;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Realms\Cartography\Area;
use App\Realms\Cartography\Point;
use App\Solutions\Y2017\D14\Visualizer\GroupExpandingVisualizer;
use loophp\collection\Collection;

/**
 * @implements Solution<DiskDefragmentationInput>
 * @see file://var/2017-14.txt
 * @see file://var/2017-14-1-sample.txt
 * @see file://var/2017-14-1-expected.txt
 * @see file://var/2017-14-2-sample.txt
 * @see file://var/2017-14-2-expected.txt
 */
final class DiskDefragmentation implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2017, 14);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $disk = DiskBuilder::fromKeyString($input->keyString);
        $area = Area::covering(Point::center(), Point::of(x: 20, y: 10));
        $sampleForVisualization = $runMode->isSample() ? $disk->cutOut($area) : $disk;

        if ($challenge->isPartOne()) {
            echo "\n\n", $sampleForVisualization->framed()->withBoxDrawing(), "\n\n";
            return substr_count((string)$disk, '#');
        }

        $delay = $runMode->isSample() ? 25_000 : 0;
        echo "\n\n";
        $result = GroupExpandingVisualizer::ofMap($sampleForVisualization, $delay);

        Collection::fromIterable($result)
            ->apply(static fn (string $output) => print($output))
            ->squash();
        echo "\n\n";

        return $result->getReturn();
    }
}
