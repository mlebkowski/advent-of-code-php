<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D11;

use App\Realms\Cartography\Point;

final readonly class FuelCell
{
    public static function of(Point $coordinate, int $gridSerialNumber): self
    {
        return new self($coordinate, $gridSerialNumber);
    }

    private function __construct(private Point $coordinate, private int $gridSerialNumber)
    {
    }

    public function powerLevel(): int
    {
        $level = $this->rackId() * $this->coordinate->y;
        $level += $this->gridSerialNumber;
        $level *= $this->rackId();
        $level /= 100;
        return (int)$level % 10 - 5;
    }

    private function rackId(): int
    {
        return $this->coordinate->x + 10;
    }
}
