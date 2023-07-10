<?php
declare(strict_types=1);

namespace App\Realms\Computing\Optimizer;

use App\Realms\Computing\Instruction\Factory\InputMatcher;
use App\Realms\Computing\Processor\Processor;
use App\Realms\Computing\Processor\Register;
use loophp\collection\Collection;
use PHPUnit\Framework\TestCase;

final class IncToMulOptimizationFactoryTest extends TestCase
{
    public function test()
    {
        $given = InputMatcher::getInstructions(
            <<<EOF
            cpy 5 c
            cpy 7 d
            inc a
            dec d
            jnz d -2
            dec c
            jnz c -5
            inc d
            EOF
        );

        $sut = IncToMulOptimizationFactory::make();
        $instructions = $sut->optimize(...$given);

        $processor = Processor::ofInstructions(...$instructions);
        $processor->run();

        self::assertSame(35, $processor->readRegister(Register::A));
        self::assertSame(0, $processor->readRegister(Register::B));
        self::assertSame(0, $processor->readRegister(Register::C));
        self::assertSame(1, $processor->readRegister(Register::D));

        $actual = Collection::fromIterable($instructions)->implode("\n");

        self::assertSame(
            <<<EOF
            cpy 5 c
            mul c 7
            add a c
            cpy 0 d
            cpy 0 c
            noop
            noop
            inc d
            EOF,
            $actual,
        );

    }
}
