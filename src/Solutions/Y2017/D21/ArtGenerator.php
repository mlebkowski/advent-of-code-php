<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D21;

use App\Realms\Cartography\Area;
use App\Realms\Cartography\Map;
use App\Realms\Cartography\Point;
use Generator;
use RuntimeException;

final readonly class ArtGenerator
{
    public static function of(EnchancementRule ...$rules): self
    {
        return new self($rules);
    }

    private function __construct(/** @var EnchancementRule[] */ private array $rules)
    {
    }

    public function enchance(Map $map): Generator
    {
        assert($map->width === $map->height);

        while (true) {
            $chunkSize = match (0) {
                $map->width % 2 => 2,
                $map->width % 3 => 3,
                default => throw new RuntimeException('Map needs to have width divisible by either 2 or 3'),
            };
            $chunkCount = $map->width / $chunkSize;

            $targetSize = $chunkCount * ($chunkSize + 1);
            $map = $this->enchanceMap($map, $chunkSize, $targetSize, $chunkCount);
            yield $map;
        }
    }

    private function enchanceMap(Map $map, int $chunkSize, int $targetSize, int $chunkCount): Map
    {
        $target = Map::empty($targetSize, $targetSize);
        for ($x = 0; $x < $chunkCount; $x++) {
            for ($y = 0; $y < $chunkCount; $y++) {
                $target = $this->enchanceRegion($map, $target, $x, $y, $chunkSize);
            }
        }
        return $target;
    }

    private function enchanceRegion(Map $map, Map $target, int $x, int $y, int $chunkSize): Map
    {
        $region = $map->cutOut(Area::covering(
            Point::of(x: $x * $chunkSize, y: $y * $chunkSize),
            Point::of(x: ($x + 1) * $chunkSize - 1, y: ($y + 1) * $chunkSize - 1),
        ));

        foreach ($this->rules as $rule) {
            if ($rule->matches($region)) {
                return $target->overlay(
                    $rule->to,
                    Point::of(x: $x * ($chunkSize + 1), y: $y * ($chunkSize + 1)),
                );
            }
        }
        throw new RuntimeException("Couldn’t find enchancement rule for region:\n$region");
    }
}
