<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D08;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Solutions\Y2016\D08\LittleScreen\Screen;
use App\Solutions\Y2016\D08\Operation\Rect;
use App\Solutions\Y2016\D08\Operation\RotateColumn;
use App\Solutions\Y2016\D08\Operation\RotateRow;
use loophp\collection\Collection;

/** @implements Solution<TwoFactorAuthenticationInput> */
final class TwoFactorAuthentication implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2016, 8);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        return Collection::fromIterable($input->operations)
            ->reduce(
                static function (Screen $screen, Rect|RotateColumn|RotateRow $operation) {
                    $screen = $screen->applyOperation($operation);
                    echo "\n", $screen, "\n";
                    return $screen;
                },
                Screen::ofSize(width: 50, height: 6),
            )
            ->countLitPixels();
    }
}
