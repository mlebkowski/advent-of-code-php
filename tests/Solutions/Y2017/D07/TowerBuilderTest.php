<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D07;

use PHPUnit\Framework\TestCase;

final class TowerBuilderTest extends TestCase
{
    public function testBuildFromShouts()
    {
        $given = [
            Shout::of(Program::of('pbga', 66)),
            Shout::of(Program::of('xhth', 57)),
            Shout::of(Program::of('ebii', 61)),
            Shout::of(Program::of('havc', 66)),
            Shout::of(Program::of('ktlj', 57)),
            Shout::of(Program::of('fwft', 72), 'ktlj', 'cntj', 'xhth'),
            Shout::of(Program::of('qoyq', 66)),
            Shout::of(Program::of('padx', 45), 'pbga', 'havc', 'qoyq'),
            Shout::of(Program::of('tknk', 41), 'ugml', 'padx', 'fwft'),
            Shout::of(Program::of('jptl', 61)),
            Shout::of(Program::of('ugml', 68), 'gyxo', 'ebii', 'jptl'),
            Shout::of(Program::of('gyxo', 61)),
            Shout::of(Program::of('cntj', 57)),
        ];

        $actual = TowerBuilder::buildFromShouts(...$given);

        $expected = [
            'tknk' => [
                'ugml' => [
                    'gyxo',
                    'ebii',
                    'jptl',
                ],
                'padx' => [
                    'pbga',
                    'havc',
                    'qoyq',
                ],
                'fwft' => [
                    'ktlj',
                    'cntj',
                    'xhth',
                ],
            ],
        ];

        self::assertSame($expected, $actual->toTree());
    }
}
