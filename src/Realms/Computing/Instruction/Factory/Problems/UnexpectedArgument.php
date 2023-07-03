<?php
declare(strict_types=1);

namespace App\Realms\Computing\Instruction\Factory\Problems;

use Exception;
use Throwable;

final class UnexpectedArgument extends Exception
{
    public static function cannotConvertToRegister(string $value, Throwable $other = null): self
    {
        return new self("The value $value does not represent a register", 0, $other);
    }

    public static function valueIsNotAnInteger(string $value): self
    {
        return new self("Provided value: '$value' is not a simple integer");
    }
}
