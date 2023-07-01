<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D17\Problems;

use Exception;

final class GotLost extends Exception
{
    /**
     * @throws GotLost
     */
    public static function whenNoAvailablePaths(int $availablePaths): void
    {
        $availablePaths || throw new self('A dead end has been reached');
    }
}
