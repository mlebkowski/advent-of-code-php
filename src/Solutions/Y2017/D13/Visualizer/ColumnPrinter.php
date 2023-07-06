<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D13\Visualizer;

interface ColumnPrinter
{
    public function column(int $picosecond, bool $hasPacket, Move $move): array;
}
