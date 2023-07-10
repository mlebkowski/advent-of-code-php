<?php
declare(strict_types=1);

namespace App\Realms\Computing\Optimizer;

use App\Realms\Computing\Instruction\Factory\InputMatcher;
use PHPUnit\Framework\TestCase;

final class PatternMatcherTest extends TestCase
{
    public function test(): void
    {
        $given = InputMatcher::getInstructions(
            <<<EOF
            cpy 7 d
            inc a
            dec d
            jnz d -2
            dec c
            jnz c -5
            EOF
        );

        $input =
            <<<EOF
            cpy :value :alpha
            inc :target
            dec :alpha
            jnz :alpha -2
            dec :bravo
            jnz :bravo -5
            EOF;

        $sut = PatternMatcher::of($input);
        $actual = $sut->match(...$given);
        self::assertSame([
            'value' => '7',
            'alpha' => 'd',
            'target' => 'a',
            'bravo' => 'c',
        ], $actual);
    }
}
