<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D08\LittleScreen;

use App\Solutions\Y2016\D08\Operation\Rect;
use App\Solutions\Y2016\D08\Operation\RotateColumn;
use App\Solutions\Y2016\D08\Operation\RotateRow;
use loophp\collection\Collection;
use Stringable;

final class Screen implements Stringable
{
    public static function ofSize(int $width, int $height): self
    {
        $pixels = array_fill(0, $width * $height, Pixel::Off);
        return new self($width, $height, $pixels);
    }

    private function __construct(private readonly int $width, private readonly int $height, private array $pixels)
    {
        assert($this->width > 0 && $this->height > 0);
        assert(count($this->pixels) === $this->width * $this->height);
    }

    public function applyOperation(Rect|RotateColumn|RotateRow $operation): self
    {
        return match ($operation::class) {
            Rect::class => $this->withRectangle($operation),
            RotateColumn::class => $this->withRotatedColumn($operation),
            RotateRow::class => $this->withRotatedRow($operation),
        };
    }

    public function countLitPixels(): int
    {
        return Collection::fromIterable($this->pixels)
            ->filter(static fn (Pixel $pixel) => $pixel->isLit())
            ->count();
    }

    /**
     * @param Line[] $rows
     */
    private static function fromRows(array $rows): self
    {
        assert(count($rows) > 0);
        $width = count($rows[0]->pixels);
        $height = count($rows);
        $pixels = Collection::fromIterable($rows)
            ->flatMap(static fn (Line $row) => $row->pixels)
            ->all();

        return new self($width, $height, $pixels);
    }

    /**
     * @param Line[] $columns
     */
    private static function fromColumns(array $columns): self
    {
        assert(count($columns) > 0);
        $width = count($columns);
        $height = count($columns[0]->pixels);
        $pixels = Collection::fromIterable($columns)
            ->map(static fn (Line $column) => $column->pixels)
            ->transpose()
            ->flatten()
            ->all();

        return new self($width, $height, $pixels);
    }

    private function withRectangle(Rect $rect): self
    {
        $pixels = Collection::fromIterable($this->pixels)
            ->map(
                fn (Pixel $pixel, int $index) => ($index / $this->width < $rect->height
                    && $index % $this->width < $rect->width)
                    ? Pixel::On
                    : $pixel,
            )
            ->all();

        return new self($this->width, $this->height, $pixels);
    }

    private function withRotatedColumn(RotateColumn $rotateColumn): self
    {
        assert($rotateColumn->x < $this->width);
        $columns = $this->toColumns();
        $columns[$rotateColumn->x] = $columns[$rotateColumn->x]->rotate($rotateColumn->offset);
        return self::fromColumns($columns);
    }

    private function withRotatedRow(RotateRow $rotateRow)
    {
        assert($rotateRow->y < $this->height);
        $rows = $this->toRows();
        $rows[$rotateRow->y] = $rows[$rotateRow->y]->rotate($rotateRow->offset);
        return self::fromRows($rows);
    }

    private function toColumns(): array
    {
        return Collection::fromIterable($this->pixels)
            ->chunk($this->width)
            ->transpose()
            ->map(static fn (array $pixels) => Line::of(...$pixels))
            ->all();
    }

    private function toRows(): array
    {
        return Collection::fromIterable($this->pixels)
            ->chunk($this->width)
            ->map(static fn (array $pixels) => Line::of(...$pixels))
            ->all();
    }

    public function __toString(): string
    {
        return Collection::fromIterable($this->pixels)
            ->map(static fn (Pixel $pixel) => $pixel->value)
            ->chunk($this->width)
            ->map(static fn (array $row) => implode('', $row))
            ->implode("\n");
    }
}
