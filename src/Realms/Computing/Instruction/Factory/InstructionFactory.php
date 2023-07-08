<?php
declare(strict_types=1);

namespace App\Realms\Computing\Instruction\Factory;

use App\Realms\Computing\Instruction\Add;
use App\Realms\Computing\Instruction\Breakpoint;
use App\Realms\Computing\Instruction\Copy;
use App\Realms\Computing\Instruction\Dec;
use App\Realms\Computing\Instruction\Halve;
use App\Realms\Computing\Instruction\Inc;
use App\Realms\Computing\Instruction\Jump;
use App\Realms\Computing\Instruction\JumpGreaterThanZero;
use App\Realms\Computing\Instruction\JumpIfEven;
use App\Realms\Computing\Instruction\JumpIfOne;
use App\Realms\Computing\Instruction\JumpNotZero;
use App\Realms\Computing\Instruction\Modulo;
use App\Realms\Computing\Instruction\Multiply;
use App\Realms\Computing\Instruction\RecoverSoundFrequency;
use App\Realms\Computing\Instruction\Set;
use App\Realms\Computing\Instruction\SignalTransmission;
use App\Realms\Computing\Instruction\Sound;
use App\Realms\Computing\Instruction\Toggle;
use App\Realms\Computing\Instruction\Triple;

final class InstructionFactory
{
    public static function debugger(string $instruction): Breakpoint
    {
        return Breakpoint::of(InputMatcher::getInstructions($instruction)[0]);
    }

    public static function out(string $value): SignalTransmission
    {
        return SignalTransmission::of(ArgumentFactory::registerOrValue($value));
    }

    public static function copy(string $alpha, string $bravo): Copy
    {
        return Copy::of(
            ArgumentFactory::registerOrValue($alpha),
            ArgumentFactory::expectRegister($bravo),
        );
    }

    public static function set(string $alpha, string $bravo): Set
    {
        return Set::of(
            ArgumentFactory::expectRegister($alpha),
            ArgumentFactory::registerOrValue($bravo),
        );
    }

    public static function inc(string $register): Inc
    {
        return Inc::of(ArgumentFactory::expectRegister($register));
    }

    public static function dec(string $register): Dec
    {
        return Dec::of(ArgumentFactory::expectRegister($register));
    }

    public static function halve(string $register): Halve
    {
        return Halve::of(ArgumentFactory::expectRegister($register));
    }

    public static function triple(string $register): Triple
    {
        return Triple::of(ArgumentFactory::expectRegister($register));
    }

    public static function jump(int $offset): Jump
    {
        return Jump::of($offset);
    }

    public static function toggle(string $register): Toggle
    {
        return Toggle::of(ArgumentFactory::expectRegister($register));
    }

    public static function jumpIfEven(string $register, int $offset): JumpIfEven
    {
        return JumpIfEven::of(ArgumentFactory::expectRegister($register), $offset);
    }

    public static function jumpIfOne(string $register, int $offset): JumpIfOne
    {
        return JumpIfOne::of(ArgumentFactory::expectRegister($register), $offset);
    }

    public static function jumpNotZero(string $alpha, string $bravo): JumpNotZero
    {
        return JumpNotZero::of(
            ArgumentFactory::registerOrValue($alpha),
            ArgumentFactory::registerOrValue($bravo),
        );
    }

    public static function jumpGreaterThanZero(string $alpha, string $bravo): JumpGreaterThanZero
    {
        return JumpGreaterThanZero::of(
            ArgumentFactory::registerOrValue($alpha),
            ArgumentFactory::registerOrValue($bravo),
        );
    }

    public static function add(string $alpha, string $bravo): Add
    {
        return Add::of(
            ArgumentFactory::expectRegister($alpha),
            ArgumentFactory::registerOrValue($bravo),
        );
    }

    public static function multiply(string $alpha, string $bravo): Multiply
    {
        return Multiply::of(
            ArgumentFactory::expectRegister($alpha),
            ArgumentFactory::registerOrValue($bravo),
        );
    }

    public static function modulo(string $alpha, string $bravo): Modulo
    {
        return Modulo::of(
            ArgumentFactory::expectRegister($alpha),
            ArgumentFactory::registerOrValue($bravo),
        );
    }

    public static function sound(string $value): Sound
    {
        return Sound::of(ArgumentFactory::registerOrValue($value));
    }

    public static function recoverFrequency(string $value): RecoverSoundFrequency
    {
        return RecoverSoundFrequency::of(ArgumentFactory::registerOrValue($value));
    }
}
