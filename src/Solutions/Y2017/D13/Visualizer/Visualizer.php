<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D13\Visualizer;

use App\Solutions\Y2017\D13\Firewall;
use App\Solutions\Y2017\D13\Spec;
use Generator;
use loophp\collection\Collection;

final readonly class Visualizer
{
    private const HideCursor = "\033[?25l";
    private const RestoreCursor = "\033[?25h";

    private int $width;
    private int $height;
    /** @var ColumnPrinter[] */
    private array $layers;
    private string $moveCursorToTop;
    private string $moveCursorToBottom;

    public static function ofSpecs(Firewall $firewall): self
    {
        return new self($firewall);
    }

    private function __construct(Firewall $firewall)
    {
        $actualWidth = $firewall->maxDepth() + 1;
        $this->width = min(10, $actualWidth);

        $this->height = $firewall->maxRange();
        $verticalJumpLength = $this->height + 2;
        $this->moveCursorToTop = "\033[{$verticalJumpLength}A";
        $this->moveCursorToBottom = "\033[{$verticalJumpLength}B";

        $specs = Collection::fromIterable($firewall->specs)
            ->map(static fn (Spec $spec) => [$spec->depth, $spec])
            ->unpack()
            ->all(false);

        $this->layers = Collection::range(0, $actualWidth)
            ->map(static fn (float $idx) => [$idx, $specs[$idx] ?? null])
            ->unpack()
            ->map(
                fn (?Spec $spec) => $spec
                    ? Scanner::of($this->height, $spec->range)
                    : UnmonitoredLayer::of($this->height),
            )
            ->all(false);
    }

    public function start(int $delay): Generator
    {
        yield self::HideCursor;
        $picosecond = $delay;
        $packet = $picosecond - $delay;
        $speed = 5;
        while ($packet < count($this->layers)) {
            usleep($speed * 25_000);

            yield $this->createMove(Move::Scanner, $picosecond, $packet);
            usleep($speed * 15_000);
            yield $this->createMove(Move::Packet, $picosecond, $packet);

            ++$picosecond;
            ++$packet;
        }

        yield $this->moveCursorToBottom . self::RestoreCursor;
    }

    public function createMove(Move $move, int $picosecond, int $packet): string
    {
        $packetDepth = $move->delayedPacketDepth() ? $packet - 1 : $packet;

        $firewall = Collection::fromIterable($this->layers)
            ->slice((int)floor(max(0, $packetDepth) / $this->width) * $this->width, $this->width)
            ->map(
                static fn (ColumnPrinter $printer, int $layer) => [
                    str_pad((string)($layer % 10), 3, pad_type: STR_PAD_BOTH),
                    ...$printer->column($picosecond, $packetDepth === $layer, $move),
                ],
            )
            ->transpose()
            ->map(static fn (array $row) => implode(' ', $row))
            ->implode("\n");

        return $firewall . "\n" . $this->moveCursorToTop;
    }
}
