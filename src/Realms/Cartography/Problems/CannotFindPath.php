<?php
declare(strict_types=1);

namespace App\Realms\Cartography\Problems;

use App\Realms\Cartography\Point;
use Exception;

final class CannotFindPath extends Exception
{
    /**
     * @throws CannotFindPath
     */
    public static function whenResultIsEmpty(array $path, Point $from, Point $to): void
    {
        count($path) || throw new self("Cannot find path between $from and $to");
    }
}
