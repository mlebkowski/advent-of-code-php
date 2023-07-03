<?php
declare(strict_types=1);

namespace App\Realms\Computing\Instruction\Factory;

use App\Realms\Computing\Instruction\Factory\Problems\UnexpectedArgument;
use App\Realms\Computing\Processor\Register;
use ValueError;

final readonly class ArgumentFactory
{
    /**
     * @throws UnexpectedArgument
     */
    public static function expectRegister(string $register): Register
    {
        try {
            return Register::from($register);
        } catch (ValueError $e) {
            throw UnexpectedArgument::cannotConvertToRegister($register, $e);
        }
    }

    /**
     * @throws UnexpectedArgument
     */
    public static function expectInteger(string $value): int
    {
        if (false === is_numeric($value) || $value !== (string)(int)$value) {
            throw UnexpectedArgument::valueIsNotAnInteger($value);
        }

        return (int)$value;
    }

    /**
     * @throws UnexpectedArgument
     */
    public static function registerOrValue(string $value): Register|int
    {
        try {
            return Register::from($value);
        } catch (ValueError) {
            return self::expectInteger($value);
        }
    }
}
