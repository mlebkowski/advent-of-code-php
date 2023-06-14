<?php

declare(strict_types=1);

namespace App\Aoc;

final class Output
{
    public static function step(mixed $value, string $meta = ''): void
    {
        $separator = $meta ? ' ' : '';
        $len = strlen((string)$value) + strlen($meta) + strlen($separator);
        $eraseUntilEndOfLine = "\033[K";
        $moveCursorLeft = "\033[{$len}D";
        $yellowBackground = "\033[0;43m";
        $greenText = "\033[32m";
        $restoreColor = "\033[0m";

        echo implode("", [
            $eraseUntilEndOfLine,
            $yellowBackground,
            $meta,
            $restoreColor,
            $separator,
            $greenText,
            $value,
            $restoreColor,
            $moveCursorLeft,
        ]);
    }
}
