<?php

declare(strict_types=1);

namespace App\Lib\Generators;

use loophp\collection\Collection;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

final class CombinationTest extends TestCase
{
    #[DataProviderExternal(CombinatoricsWithoutRepeatsDataProvider::class, 'data')]
    public function test without repeats(array $input, int $size, array $expected): void
    {
        $sut = Combination::takeWithoutRepeats($size)->from($input);
        $actual = iterator_to_array($sut);
        self::assertSame($expected, $actual);
    }

    #[DataProviderExternal(CombinatoricsWithoutRepeatsDataProvider::class, 'range')]
    public function test take range(array $input, int $from, int $to, array $expected): void
    {
        $sut = Combination::rangeWithoutRepeats($from, $to)->from($input);
        $actual = Collection::fromGenerator($sut)->all();
        self::assertSame($expected, $actual);
    }
}
