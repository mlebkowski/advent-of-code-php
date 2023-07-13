<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D13\Input;

use App\Realms\Cartography\Orientation;
use App\Realms\Cartography\Point;
use App\Solutions\Y2018\D13\Cart;
use PHPUnit\Framework\TestCase;

final class CartFinderTest extends TestCase
{
    public function test from drawing(): void
    {
        $given = <<<EOF
        .->-.        
        |   |  .----.
        | .-+--+-.  |
        | | |  | v  |
        '-+-'  '-+--'
          '------' 
        EOF;

        $actual = CartFinder::fromDrawing($given);
        self::assertEquals(
            [
                Cart::of(Point::of(2, 0), Orientation::East),
                Cart::of(Point::of(9, 3), Orientation::South),
            ],
            $actual,
        );
    }
}
