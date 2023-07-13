<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D13\Input;

use PHPUnit\Framework\TestCase;

final class PathConverterTest extends TestCase
{
    public function test simple(): void
    {
        // formatter:off
        $given = <<<EOF
        /->-\\        
        |   |  /----\\
        | /-+--+-\\  |
        | | |  | v  |
        \\-+-/  \\-+--/
          \\------/
        EOF;
        // formatter:on

        $expected = <<<EOF
        ┌───┐        
        │   │  ┌────┐
        │ ┌─┼──┼─┐  │
        │ │ │  │ │  │
        └─┼─┘  └─┼──┘
          └──────┘
        EOF;

        $actual = PathConverter::convert($given);
        self::assertSame($expected, $actual);
    }

    public function test advanced(): void
    {
        $given = file_get_contents(__DIR__ . '/given.txt');
        $expected = file_get_contents(__DIR__ . '/expected.txt');
        $actual = PathConverter::convert($given);
        self::assertSame($expected, $actual);
    }
}
