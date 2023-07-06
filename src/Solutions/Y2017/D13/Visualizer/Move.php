<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D13\Visualizer;

enum Move
{
    case Packet;
    case Scanner;

    public function highlightCollisions(): bool
    {
        return $this === self::Packet;
    }

    public function delayedPacketDepth(): bool
    {
        return $this === self::Scanner;
    }
}
