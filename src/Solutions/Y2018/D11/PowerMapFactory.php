<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D11;

use App\Realms\Ansi\Ansi;
use App\Realms\Ansi\Background;
use App\Realms\Cartography\Map;
use App\Realms\Cartography\Point;

final readonly class PowerMapFactory
{
    public static function ofSize(int $size, int $serial): Map
    {
        $points = [];
        $levels = [
            4 => Background::Red,
            3 => Background::Yellow,
            2 => Background::White,
            1 => Background::Green,
            0 => Background::Blue,
            -1 => Background::Cyan,
            -2 => Background::Purple,
            -3 => Background::Black,
            -4 => Background::Black,
            -5 => Background::Black,
        ];

        for ($x = 1; $x <= $size; $x++) {
            for ($y = 1; $y <= $size; $y++) {
                $level = FuelCell::powerLevel(Point::of($x, $y), $serial);
                $points[] = Ansi::color(' ', background: $levels[$level]);
            }
        }
        return Map::ofPoints($points, $size);
    }
}
