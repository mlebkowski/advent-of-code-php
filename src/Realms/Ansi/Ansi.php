<?php
declare(strict_types=1);

namespace App\Realms\Ansi;

final readonly class Ansi
{
    public static function color(
        string $input,
        Foreground $foreground = Foreground::Default,
        Background $background = Background::Default,
        Intensity $intensity = Intensity::Reset,
    ): string {
        return sprintf(
            "\033[%d;%d;%dm%s\033[0m",
            $intensity->value,
            $foreground->value,
            $background->value,
            $input,
        );
    }

    public static function yellow(string $string): string
    {
        return self::color($string, Foreground::Yellow);
    }

    public static function white(string $string): string
    {
        return self::color($string, Foreground::White);
    }

    public static function moveUp(int $height): string
    {
        return sprintf(Cursor::Up->value, $height);
    }

    public static function moveDown(int $height): string
    {
        return sprintf(Cursor::Down->value, $height);
    }
}
