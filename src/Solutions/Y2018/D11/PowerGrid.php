<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D11;

use App\Realms\Cartography\Point;

final readonly class PowerGrid
{
    public const Size = 300;

    public static function of(int $serial): self
    {
        $grid = [];
        for ($x = 0; $x < self::Size; $x++) {
            for ($y = 0; $y < self::Size; $y++) {
                $grid[$y][$x] = FuelCell::powerLevel(Point::of($x + 1, $y + 1), $serial);
            }
        }
        return new self($grid);
    }

    private function __construct(public array $grid)
    {
    }
}
