<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D11;

use loophp\collection\Collection;

final readonly class Path
{
    public static function of(array $counts): self
    {
        $counts += array_map(static fn () => 0, self::expectedKeys());

        return new self($counts);
    }

    public static function ofDirections(HexDirection ...$directions): self
    {
        return self::of(
            Collection::fromIterable($directions)
                ->groupBy(static fn (HexDirection $direction) => $direction->value)
                ->map(static fn (array $directions) => count($directions))
                ->all(false),
        );
    }

    private function __construct(public array $counts)
    {
        $expectedKeys = self::expectedKeys();

        assert([] === array_diff_key($this->counts, $expectedKeys));
        assert([] === array_diff_key($expectedKeys, $this->counts));
    }

    public function sum(): int
    {
        return array_sum($this->counts);
    }

    public function reduceOpposites(HexDirection $direction): self
    {
        $opposite = $direction->opposite();
        $diff = min($this->counts[$direction->value], $this->counts[$opposite->value]);

        $counts = [
            $direction->value => $this->counts[$direction->value] - $diff,
            $opposite->value => $this->counts[$opposite->value] - $diff,
        ];

        return new self($counts + $this->counts);
    }

    public function reduceShortcuts(HexDirection $direction, HexDirection $alpha, HexDirection $bravo): self
    {
        $diff = min($this->counts[$alpha->value], $this->counts[$bravo->value]);
        $counts = [
            $direction->value => $this->counts[$direction->value] + $diff,
            $alpha->value => $this->counts[$alpha->value] - $diff,
            $bravo->value => $this->counts[$bravo->value] - $diff,
        ];
        return new self($counts + $this->counts);
    }

    private static function expectedKeys(): array
    {
        return array_flip(
            array_map(
                static fn (HexDirection $direction) => $direction->value,
                HexDirection::cases(),
            ),
        );
    }
}
