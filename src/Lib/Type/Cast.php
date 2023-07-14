<?php
/** @noinspection PhpDocSignatureInspection */
declare(strict_types=1);

namespace App\Lib\Type;

use BackedEnum;
use RuntimeException;

final readonly class Cast
{
    public static function identity(mixed $value): mixed
    {
        return $value;
    }

    public static function toInt(mixed $value): int
    {
        if (false === is_numeric($value)) {
            throw new RuntimeException("Error casting non-numeric value to integer: $value");
        }

        return (int)$value;
    }

    public static function toString(mixed $value): string
    {
        return (string)$value;
    }

    public static function toEnumValue(BackedEnum $enum): int|string
    {
        return $enum->value;
    }

    /** @return PointCast */
    public static function point(): string
    {
        return PointCast::class;
    }
}
