<?php
declare(strict_types=1);

namespace App\Realms\Ansi;

final readonly class Ansi
{
    public static function bgYellow(string $string): string
    {
        return sprintf('%s%s%s', Colors::YellowBackground->value, $string, Colors::Reset->value);
    }

    public static function yellow(string $string): string
    {
        return sprintf('%s%s%s', Colors::Yellow->value, $string, Colors::Reset->value);
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
