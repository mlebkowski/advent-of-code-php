<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D17;

enum Lock
{
    case Open;
    case Closed;

    public static function fromString(string $char): self
    {
        return in_array($char, ['b', 'c', 'd', 'e', 'f'], true) ? self::Open : self::Closed;
    }

    public function allowsPassage(): bool
    {
        return $this === self::Open;
    }
}
