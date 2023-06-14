<?php

declare(strict_types=1);

namespace App\Aoc;

final class Progress
{
    public static function step(mixed $value, string $meta = ''): true
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

        return true;
    }

    public static function ofExpectedIterations(int $expectedIterations): callable
    {
        $start = microtime(true);
        $i = 0;
        $iPad = (int)floor(log10($expectedIterations)) + 1;
        return static function (mixed $value) use (&$i, $iPad, $expectedIterations, $start): true {
            $i++;

            $percentage = $i / $expectedIterations;
            $elapsed = microtime(true) - $start;
            $expectedTime = (round($elapsed) / $percentage) * (1 - $percentage);

            $meta = sprintf(
                '[ %s / % 2.0f%% / %ds ]',
                str_pad((string)$i, $iPad, pad_type: STR_PAD_LEFT),
                $percentage * 100,
                $expectedTime,
            );

            return self::step($value, $meta);
        };
    }
}
