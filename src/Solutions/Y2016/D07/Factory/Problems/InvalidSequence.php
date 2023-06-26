<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D07\Factory\Problems;

use App\Solutions\Y2016\D07\Factory\NetMode;
use Exception;

final class InvalidSequence extends Exception
{
    /**
     * @throws InvalidSequence
     */
    public static function whenAlreadyInThatMode(NetMode $expected, NetMode $actual): void
    {
        $expected === $actual && throw new self(
            sprintf(
                'Error switching to %s: already in that mode',
                $expected->name,
            ),
        );
    }
}
