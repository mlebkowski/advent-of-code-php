<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D07\Factory\Problems;

use Exception;

final class EmptySequence extends Exception
{
    /**
     * @throws EmptySequence
     */
    public static function whenNothingInBuffer(string $buffer): void
    {
        "" === $buffer && throw new self('Parsing error: unexpected empty sequence');
    }
}
