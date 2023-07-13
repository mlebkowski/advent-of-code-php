<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D13\Input;

use App\Realms\Cartography\BoxDrawing\BoxDrawingConverter;

final readonly class PathConverter
{
    public static function convert(string $input): string
    {
        $withoutCarts = strtr($input, [
            '>' => '-',
            '<' => '-',
            '^' => '|',
            'v' => '|',
        ]);

        return BoxDrawingConverter::fromPoorMansAscii($withoutCarts);
    }
}
