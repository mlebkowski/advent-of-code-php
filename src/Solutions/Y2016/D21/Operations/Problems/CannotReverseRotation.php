<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D21\Operations\Problems;

use Exception;

final class CannotReverseRotation extends Exception
{
    /**
     * @throws CannotReverseRotation
     */
    public static function whenLengthIsOdd(int $length): void
    {
        1 === $length % 2 && throw new self(
            'RotateBasedOnLetter is irreversible for strings with odd-length',
        );
    }
}
