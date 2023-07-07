<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D13\Visualizer;

use loophp\collection\Collection;

final readonly class Scanner implements ColumnPrinter
{
    private const HighlightColor = "\033[0;41m";
    private const RestoreColor = "\033[0m";

    public static function of(int $height, int $range): self
    {
        return new self($height, $range);
    }

    private function __construct(private int $height, private int $range)
    {
    }

    public function column(int $picosecond, bool $hasPacket, Move $move): array
    {
        $term = ($this->range - 1) * 2;
        $halfway = $this->range - 1;
        $picosecond %= $term;
        $position = $halfway - abs($halfway - $picosecond);

        return Collection::fromIterable(range(0, $this->height))
            ->map(fn (int $rowNo) => match (true) {
                $rowNo >= $this->range => str_repeat(' ', 3),
                $rowNo === 0 => match ([true, true]) {
                    [$position === 0, $hasPacket] => match ($move->highlightCollisions()) {
                        false => '(S)',
                        true => self::HighlightColor . '(S)' . self::RestoreColor,
                    },
                    [$position === 0, false === $hasPacket] => '[S]',
                    [$position !== 0, $hasPacket] => '(.)',
                    [$position !== 0, false === $hasPacket] => '[ ]',
                },
                default => match (true) {
                    $position === $rowNo => '[S]',
                    $position !== $rowNo => '[ ]',
                },
            })
            ->all();
    }
}
