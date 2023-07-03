<?php
declare(strict_types=1);

namespace App\Realms\Computing\Instruction;

use App\Realms\Computing\Processor\Register;

final class InstructionFactory
{
    public static function copy(string $alpha, string $bravo): Copy
    {
        return Copy::of(
            Register::tryFrom($alpha) ?? (int)$alpha,
            Register::from($bravo),
        );
    }

    public static function inc(string $register): Inc
    {
        return Inc::of(Register::from($register));
    }

    public static function dec(string $register): Dec
    {
        return Dec::of(Register::from($register));
    }

    public static function halve(string $register): Halve
    {
        return Halve::of(Register::from($register));
    }

    public static function triple(string $register): Triple
    {
        return Triple::of(Register::from($register));
    }

    public static function jump(int $offset): Jump
    {
        return Jump::of($offset);
    }

    public static function jumpIfEven(string $register, int $offset): JumpIfEven
    {
        return JumpIfEven::of(Register::from($register), $offset);
    }

    public static function jumpIfOne(string $register, int $offset): JumpIfOne
    {
        return JumpIfOne::of(Register::from($register), $offset);
    }

    public static function jumpNotZero(string $alpha, string $bravo): JumpNotZero
    {
        return JumpNotZero::of(
            Register::tryFrom($alpha) ?? (int)$alpha,
            (int)$bravo,
        );
    }
}
