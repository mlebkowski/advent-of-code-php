<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D09\Parser\Problems;

use App\Solutions\Y2017\D09\Parser\Token;
use Exception;

final class UnexpectedEndOfFile extends Exception
{
    /**
     * @throws UnexpectedEndOfFile
     */
    public static function whenNoMoreTokens(?Token $token): void
    {
        $token || throw new self('Unexpected eof while reading tokens');
    }
}
