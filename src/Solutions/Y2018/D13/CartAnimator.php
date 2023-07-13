<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D13;

use App\Realms\Ansi\Ansi;
use App\Solutions\Y2018\D13\Events\Abort;
use App\Solutions\Y2018\D13\Events\Crash;
use Generator;

final class CartAnimator
{
    /**
     * @return Generator<int,Abort,Crash>
     */
    public static function animate(string $map, Fleet $fleet, int $delay): Generator
    {
        $height = substr_count($map, "\n") + 1;
        echo $map, "\n", Ansi::moveUp($height) . Ansi::hideCursor();

        $grid = array_map(
            mb_str_split(...),
            explode("\n", $map),
        );

        $cartIcon = Ansi::yellow('•');
        $crashIcon = Ansi::red('×');

        foreach ($fleet as $cart) {
            echo Ansi::at(
                $cart->position->x,
                $cart->position->y,
                $cartIcon,
            );
        }

        while (true) {
            $cart = $fleet->current();
            $gridChar = $grid[$cart->position->y][$cart->position->x];
            echo Ansi::at(
                $cart->position->x,
                $cart->position->y,
                $gridChar,
            );

            $cart = $fleet->step($gridChar);
            foreach ($fleet as $other) {
                if ($other !== $cart && $other->position->equals($cart->position)) {
                    echo Ansi::at(
                        $cart->position->x,
                        $cart->position->y,
                        $crashIcon,
                    );
                    $signal = yield Crash::of($cart->position);
                    if ($signal instanceof Abort) {
                        break 2;
                    }
                }
            }

            echo Ansi::at(
                $cart->position->x,
                $cart->position->y,
                $cartIcon,
            );
            usleep($delay);
        }

        echo Ansi::moveDown($height) . Ansi::showCursor();
    }
}
