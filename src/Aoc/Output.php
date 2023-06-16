<?php

declare(strict_types=1);

namespace App\Aoc;

final class Output
{
    private static $lastOutputLength = 0;

    public static function step(mixed $value, string $meta = ''): void
    {
        $separator = $meta ? ' ' : '';
        $lastOutputLength = self::$lastOutputLength;
        $len = strlen((string)$value) + strlen($meta) + strlen($separator);
        self::$lastOutputLength = $len;
        $padding = str_pad(' ', max(0, $lastOutputLength - $len));
        $len += strlen($padding);
        $moveCursorLeft = "\033[{$len}D";
        $yellowBackground = "\033[0;43m";
        $greenText = "\033[32m";
        $restoreColor = "\033[0m";

        echo implode("", [
            $yellowBackground,
            $meta,
            $restoreColor,
            $separator,
            $greenText,
            $value,
            $restoreColor,
            $padding,
            $moveCursorLeft,
        ]);
    }
}
