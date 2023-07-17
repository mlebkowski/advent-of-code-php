<?php
declare(strict_types=1);

namespace App\Realms\Ansi;

final readonly class Ansi
{
    public static function at(int $right, int $down, string $input): string
    {
        return self::moveDown($down) . self::moveRight($right) . $input . "\n" . self::moveUp($down + 1);
    }

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

    public static function gray(string $string): string
    {
        return self::color($string, Foreground::White, intensity: Intensity::Faint);
    }

    public static function blue(string $string): string
    {
        return self::color($string, Foreground::Blue);
    }

    public static function blueBg(string $string): string
    {
        return self::color($string, background: Background::Blue);
    }

    public static function green(string $string): string
    {
        return self::color($string, foreground: Foreground::Green);
    }

    public static function yellow(string $string): string
    {
        return self::color($string, Foreground::Yellow);
    }

    public static function red(string $string): string
    {
        return self::color($string, Foreground::Red);
    }

    public static function white(string $string): string
    {
        return self::color($string, Foreground::White);
    }

    public static function hideCursor(): string
    {
        return Cursor::Hide->value;
    }

    public static function showCursor(): string
    {
        return Cursor::Restore->value;
    }

    public static function moveUp(int $distance): string
    {
        return $distance ? sprintf(Cursor::Up->value, $distance) : '';
    }

    public static function moveLeft(int $distance): string
    {
        return $distance ? sprintf(Cursor::Left->value, $distance) : '';
    }

    public static function moveDown(int $distance): string
    {
        return $distance ? sprintf(Cursor::Down->value, $distance) : '';
    }

    public static function moveRight(int $distance): string
    {
        return $distance ? sprintf(Cursor::Right->value, $distance) : '';
    }

    public static function clearScren(): string
    {
        return "\033[2J\033[0;0H";
    }
}
