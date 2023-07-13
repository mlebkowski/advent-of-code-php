<?php
declare(strict_types=1);

namespace App\Realms\Cartography\BoxDrawing;

use App\Realms\Cartography\Orientation;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class LineTest extends TestCase
{
    public static function data follow direction(): iterable
    {
        yield [Line::CornerTopLeft, Orientation::North, Orientation::East];
        yield [Line::CornerTopLeft, Orientation::West, Orientation::South];
        yield [Line::Horizontal, Orientation::East, Orientation::East];
        yield [Line::Intersection, Orientation::West, Orientation::West];
        yield [Line::Intersection, Orientation::North, Orientation::North];
    }

    #[DataProvider('data follow direction')]
    public function test follow direction(Line $sut, Orientation $given, Orientation $expected): void
    {
        $actual = $sut->followDirection($given);
        self::assertSame($expected, $actual);
    }
}
