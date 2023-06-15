<?php

declare(strict_types=1);

namespace App\Aoc\Runner;

use PHPUnit\Framework\TestCase;

final class TargetClassEvaluatorTest extends TestCase
{
    public function test input()
    {
        $sut = new TargetClassEvaluator();
        $actual = $sut->getTargetClass(new SampleParser());

        self::assertSame(SampleInput::class, $actual);
    }

    public function test solution()
    {
        $sut = new TargetClassEvaluator();
        $actual = $sut->getTargetClass(new SampleSolution());

        self::assertSame(SampleInput::class, $actual);
    }
}
