<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D24;

use PHPUnit\Framework\TestCase;

final class BridgeBuilderTest extends TestCase
{
    public function test(): void
    {
        $given = [
            Component::of(0, 2),
            Component::of(2, 2),
            Component::of(2, 3),
            Component::of(3, 4),
            Component::of(3, 5),
            Component::of(0, 1),
            Component::of(10, 1),
            Component::of(9, 10),
        ];
        $sut = BridgeBuilder::of(...$given);
        $actual = iterator_to_array($sut->build(), preserve_keys: false);
        self::assertSame(
            <<<EOF
            0/2
            0/2--2/2
            0/2--2/2--2/3
            0/2--2/2--2/3--3/4
            0/2--2/2--2/3--3/5
            0/2--2/3
            0/2--2/3--3/4
            0/2--2/3--3/5
            0/1
            0/1--1/10
            0/1--1/10--10/9
            EOF,
            implode("\n", $actual),
        );
    }
}
