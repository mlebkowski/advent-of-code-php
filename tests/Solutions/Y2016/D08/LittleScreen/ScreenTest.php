<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D08\LittleScreen;

use App\Solutions\Y2016\D08\Operation\Rect;
use App\Solutions\Y2016\D08\Operation\RotateColumn;
use App\Solutions\Y2016\D08\Operation\RotateRow;
use PHPUnit\Framework\TestCase;

final class ScreenTest extends TestCase
{
    public function test(): void
    {
        $sut = Screen::ofSize(width: 7, height: 3);

        $sut = $sut->applyOperation(Rect::of(width: 3, height: 2));
        self::assertSame(
            <<<EOF
            ███....
            ███....
            .......
            EOF,
            strtr((string)$sut, [' ' => '.']),
        );

        $sut = $sut->applyOperation(RotateColumn::of(x: 1, offset: 1));
        self::assertSame(
            <<<EOF
            █.█....
            ███....
            .█.....
            EOF,
            strtr((string)$sut, [' ' => '.']),
        );

        $sut = $sut->applyOperation(RotateRow::of(y: 0, offset: 4));
        self::assertSame(
            <<<EOF
            ....█.█
            ███....
            .█.....
            EOF,
            strtr((string)$sut, [' ' => '.']),
        );

        $sut = $sut->applyOperation(RotateColumn::of(x: 1, offset: 1));
        self::assertSame(
            <<<EOF
            .█..█.█
            █.█....
            .█.....
            EOF,
            strtr((string)$sut, [' ' => '.']),
        );
    }
}
