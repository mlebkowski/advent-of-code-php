<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D03\Builder;

use App\Realms\Cartography\Map;
use App\Realms\Cartography\Point;
use loophp\collection\Collection;
use loophp\collection\Contract\Operation\Sortable;
use PHPUnit\Framework\TestCase;

final class SpiralBuilderTest extends TestCase
{
    public function test sequential(): void
    {
        $sut = SpiralBuilder::sequential();
        $points = Collection::fromGenerator($sut)
            ->limit(49)
            ->sort(type: Sortable::BY_KEYS, callback: Point::sortForGrid(...))
            ->map(static fn (int $value) => str_pad((string)$value, 4, pad_type: STR_PAD_LEFT))
            ->all();
        $map = Map::ofPoints($points, 7);

        self::assertSame(
            <<<MAP
              37  36  35  34  33  32  31
              38  17  16  15  14  13  30
              39  18   5   4   3  12  29
              40  19   6   1   2  11  28
              41  20   7   8   9  10  27
              42  21  22  23  24  25  26
              43  44  45  46  47  48  49
            MAP,
            (string)$map,
        );
    }

    public function test adjacent(): void
    {
        $sut = SpiralBuilder::adjacent();
        $points = Collection::fromGenerator($sut)
            ->limit(25)
            ->sort(type: Sortable::BY_KEYS, callback: Point::sortForGrid(...))
            ->map(static fn (int $value) => str_pad((string)$value, 5, pad_type: STR_PAD_LEFT))
            ->all();
        $map = Map::ofPoints($points, 5);

        self::assertSame(
            <<<MAP
              147  142  133  122   59
              304    5    4    2   57
              330   10    1    1   54
              351   11   23   25   26
              362  747  806  880  931
            MAP,
            (string)$map,
        );
    }
}
