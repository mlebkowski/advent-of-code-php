<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D02\Keypad;

use App\Solutions\Y2016\D02\Move\Direction;
use loophp\collection\Collection;

final readonly class Keypad
{
    private const StartingButton = '5';

    public static function ofLayout(string $layout): self
    {
        $keypad = Collection::fromString($layout)
            ->lines()
            ->map(self::ofRow(...));

        $starting = $keypad
            ->map(static fn (array $values) => array_search(self::StartingButton, $values, true))
            ->filter(static fn (bool|int $row) => false !== $row)
            ->pack()
            ->first();

        return new self($keypad->all(false), $starting);
    }

    private function __construct(public array $layout, public array $cursor)
    {
    }

    public function move(Direction $direction): self
    {
        $cursor = match ($direction) {
            Direction::Down => [$this->cursor[0] + 1, $this->cursor[1]],
            Direction::Up => [$this->cursor[0] - 1, $this->cursor[1]],
            Direction::Left => [$this->cursor[0], $this->cursor[1] - 1],
            Direction::Right => [$this->cursor[0], $this->cursor[1] + 1],
        };

        return isset($this->layout[$cursor[0]][$cursor[1]]) ? new self($this->layout, $cursor) : $this;
    }

    public function value(): string
    {
        return $this->layout[$this->cursor[0]][$this->cursor[1]];
    }

    private static function ofRow(string $row): array
    {
        return Collection::fromString($row)
            ->reject(static fn (string $value, int $idx) => $idx % 2)
            ->normalize()
            ->reject(static fn (string $value) => $value === ' ')
            ->all(false);
    }
}
