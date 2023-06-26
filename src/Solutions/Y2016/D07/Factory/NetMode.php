<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D07\Factory;

use App\Solutions\Y2016\D07\Factory\Problems\InvalidSequence;
use RuntimeException;

enum NetMode: string
{
    case SuperNet = 'supernet';
    case HyperNet = 'hypernet';

    public static function of(string $char): self
    {
        return match ($char) {
            '[' => self::HyperNet,
            ']' => self::SuperNet,
            default => throw new RuntimeException("Unknown mode: $char"),
        };
    }

    /**
     * @throws InvalidSequence
     */
    public function switchTo(self $other): self
    {
        InvalidSequence::whenAlreadyInThatMode($other, $this);
        return $other;
    }
}
