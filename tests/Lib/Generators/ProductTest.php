<?php

declare(strict_types=1);

namespace App\Lib\Generators;

use loophp\collection\Collection;
use PHPUnit\Framework\TestCase;

final class ProductTest extends TestCase
{
    public function test of iterables(): void
    {
        $sut = Product::ofIterables(
            [['W1'], ['W2']],
            [[], ['A1'], ['A2']],
            [[], ['R1'], ['R2'], ['R3'], ['R1', 'R2'], ['R1', 'R3'], ['R2', 'R3']],
        );

        $actual = Collection::fromIterable($sut)->all();
        self::assertSame(
            [
                ['W1'],
                ['W1', 'R1'],
                ['W1', 'R2'],
                ['W1', 'R3'],
                ['W1', 'R1', 'R2'],
                ['W1', 'R1', 'R3'],
                ['W1', 'R2', 'R3'],

                ['W1', 'A1'],
                ['W1', 'A1', 'R1'],
                ['W1', 'A1', 'R2'],
                ['W1', 'A1', 'R3'],
                ['W1', 'A1', 'R1', 'R2'],
                ['W1', 'A1', 'R1', 'R3'],
                ['W1', 'A1', 'R2', 'R3'],

                ['W1', 'A2'],
                ['W1', 'A2', 'R1'],
                ['W1', 'A2', 'R2'],
                ['W1', 'A2', 'R3'],
                ['W1', 'A2', 'R1', 'R2'],
                ['W1', 'A2', 'R1', 'R3'],
                ['W1', 'A2', 'R2', 'R3'],

                ['W2'],
                ['W2', 'R1'],
                ['W2', 'R2'],
                ['W2', 'R3'],
                ['W2', 'R1', 'R2'],
                ['W2', 'R1', 'R3'],
                ['W2', 'R2', 'R3'],

                ['W2', 'A1'],
                ['W2', 'A1', 'R1'],
                ['W2', 'A1', 'R2'],
                ['W2', 'A1', 'R3'],
                ['W2', 'A1', 'R1', 'R2'],
                ['W2', 'A1', 'R1', 'R3'],
                ['W2', 'A1', 'R2', 'R3'],

                ['W2', 'A2'],
                ['W2', 'A2', 'R1'],
                ['W2', 'A2', 'R2'],
                ['W2', 'A2', 'R3'],
                ['W2', 'A2', 'R1', 'R2'],
                ['W2', 'A2', 'R1', 'R3'],
                ['W2', 'A2', 'R2', 'R3'],

            ],
            $actual,
        );
    }
}
