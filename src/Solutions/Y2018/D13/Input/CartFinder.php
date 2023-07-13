<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D13\Input;

use App\Realms\Cartography\Orientation;
use App\Realms\Cartography\Point;
use App\Solutions\Y2018\D13\Cart;

final readonly class CartFinder
{
    public static function fromDrawing(string $input): array
    {
        preg_match_all(
            '/[<>^v]/',
            $input,
            $matches,
            PREG_OFFSET_CAPTURE,
        );

        return iterator_to_array(self::parseResults($input, $matches[0]));
    }

    private static function parseResults(string $input, array $matches): iterable
    {
        foreach ($matches as [$cart, $offset]) {
            $previousNewline = strrpos($input, "\n", $offset - strlen($input)) ?: -1;
            $x = $offset - ($previousNewline + 1);
            $y = substr_count($input, "\n", 0, $offset);
            $direction = match ($cart) {
                '>' => Orientation::East,
                'v' => Orientation::South,
                '<' => Orientation::West,
                '^' => Orientation::North,
            };
            yield Cart::of(Point::of($x, $y), $direction);
        }
    }
}
