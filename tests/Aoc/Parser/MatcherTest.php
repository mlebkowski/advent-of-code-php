<?php
declare(strict_types=1);

namespace App\Aoc\Parser;

use PHPUnit\Framework\TestCase;

final class MatcherTest extends TestCase
{
    public function test matches simple patterns(): void
    {
        $given = '/dev/grid/node-x0-y9     88T   69T    19T   78%';
        $sut = Matcher::simple('/dev/grid/node-x%d-y%d %dT %dT', CatchAllValueObject::of(...));
        /** @var CatchAllValueObject $actual */
        $actual = $sut($given);
        self::assertSame(
            [0, 9, 88, 69],
            $actual->arguments,
        );
    }

    public function test matches against many lines(): void
    {
        $given = <<<EOF
        root@ebhq-gridcenter# df -h
        Filesystem              Size  Used  Avail  Use%
        /dev/grid/node-x0-y0     88T   66T    22T   75%
        /dev/grid/node-x0-y1     85T   65T    20T   76%
        /dev/grid/node-x0-y2     88T   67T    21T   76%
        /dev/grid/node-x0-y3     92T   68T    24T   73%
        /dev/grid/node-x0-y4     87T   64T    23T   73%
        EOF;

        $sut = Matcher::simple('/dev/grid/node-x%d-y%d %dT %dT', CatchAllValueObject::of(...));

        $actual = $sut->matchLines($given, skip: 2);
        self::assertSame(
            [
                [0, 0, 88, 66],
                [0, 1, 85, 65],
                [0, 2, 88, 67],
                [0, 3, 92, 68],
                [0, 4, 87, 64],
            ],
            CatchAllValueObject::extractArguments(...$actual),
        );
    }

    public function test matches many patterns(): void
    {
        $given = <<<EOF
        swap position 0 with position 2
        swap letter d with letter a
        rotate right 4 steps
        rotate left 6 steps
        rotate based on position of letter a
        reverse positions 1 through 6
        move position 2 to position 1
        EOF;

        $sut = MatcherBuilder::create()
            ->startsWith('swap position', '%d with position %d', CatchAllValueObject::named('swap position'))
            ->startsWith('swap letter', '%s with letter %s', CatchAllValueObject::named('swap letter'))
            ->startsWith('rotate left', '%d steps', CatchAllValueObject::named('rotate left'))
            ->startsWith('rotate right', '%d steps', CatchAllValueObject::named('rotate right'))
            ->startsWith('rotate based on position of letter', '%s', CatchAllValueObject::named('rotate based on position of letter'))
            ->startsWith('reverse positions', '%d through %d', CatchAllValueObject::named('reverse positions'))
            ->startsWith('move position', '%d to position %d', CatchAllValueObject::named('move position'))
            ->getMatcher();

        $actual = $sut->matchLines($given);

        self::assertSame(
            [
                ['swap position', 0, 2],
                ['swap letter', 'd', 'a'],
                ['rotate right', 4],
                ['rotate left', 6],
                ['rotate based on position of letter', 'a'],
                ['reverse positions', 1, 6],
                ['move position', 2, 1],
            ],
            CatchAllValueObject::extractArguments(...$actual),
        );

    }

    public function test matches until the end of line(): void
    {
        $given = <<<EOF
        • jnz 1 c
        program ktlj (57)
        program fwft (72) -> ktlj, cntj, xhth
        EOF;

        $matcher = MatcherBuilder::create()
            ->prefixed('•', CatchAllValueObject::named('•'))
            ->startsWith('program', '%s (%d) -> %...', CatchAllValueObject::named('program'))
            ->getMatcher();

        $actual = $matcher->matchLines($given);

        self::assertSame(
            [
                ['•', 'jnz 1 c'],
                ['program', 'ktlj', 57],
                ['program', 'fwft', 72, 'ktlj, cntj, xhth'],
            ],
            CatchAllValueObject::extractArguments(...$actual),
        );
    }
}
