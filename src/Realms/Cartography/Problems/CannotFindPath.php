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

    /**
     * @throws CannotFindPath
     */
    public static function whenPointsIsOutsideTheGrid($node, Point $point): void
    {
        $node || throw new self("Cannot find path to a point $point outside of the grid");
    }
}
