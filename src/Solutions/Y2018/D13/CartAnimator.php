<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D13;

use App\Realms\Ansi\Ansi;

final class CartAnimator
{
    public static function animate(string $map, Fleet $fleet): iterable
    {
        $height = substr_count($map, "\n") + 1;
        echo $map, "\n", Ansi::moveUp($height) . Ansi::hideCursor();

        $grid = array_map(
            mb_str_split(...),
            explode("\n", $map),
        );

        $steps = 100;
        $cartIcon = Ansi::yellow('•');
        $crashIcon = Ansi::red('×');

        foreach ($fleet as $cart) {
            echo Ansi::at(
                $cart->position->x,
                $cart->position->y,
                $cartIcon,
            );
        }

        while ($steps-- > 0) {
            $cart = $fleet->current();
            $gridChar = $grid[$cart->position->y][$cart->position->x];
            echo Ansi::at(
                $cart->position->x,
                $cart->position->y,
                $gridChar,
            );
            $cart = $fleet->step($gridChar);
            echo Ansi::at(
                $cart->position->x,
                $cart->position->y,
                $cartIcon,
            );
            usleep(30_000);
        }

        echo Ansi::moveDown($height) . Ansi::showCursor();
        return [];
    }
}
