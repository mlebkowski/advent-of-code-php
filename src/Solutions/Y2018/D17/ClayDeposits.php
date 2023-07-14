<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D17;

use App\Lib\Filters\Text;
use App\Lib\Type\Cast;
use App\Realms\Cartography\Map;
use App\Realms\Cartography\Point;

final readonly class ClayDeposits
{
    public static function ofMap(Map $map): self
    {
        $points = $map->withCoordinates()
            ->filter(Text::in('#', '█'))
            ->keys()
            ->map(Cast::toString(...))
            ->all();
        return new self($points);
    }

    private function __construct(private array $points)
    {
    }

    public function blocksWater(Point $point): bool
    {
        return in_array((string)$point, $this->points, true);
    }
}
