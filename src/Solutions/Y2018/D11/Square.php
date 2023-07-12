<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D11;

use App\Lib\Type\Cast;
use App\Realms\Cartography\Point;
use loophp\collection\Collection;

final readonly class Square
{
    public static function of(int $size, Point $topLeft, int $serialNumber): self
    {
        $cells = Collection::range(0, $size)
            ->map(Cast::toInt(...))
            ->product(Collection::range(0, $size)->map(Cast::toInt(...)))
            ->map(static fn (array $xy) => FuelCell::of(
                Point::of(...$xy)->offset($topLeft->opposite()),
                $serialNumber,
            ))
            ->all();
        return new self($cells, "$topLeft->x,$topLeft->y");
    }

    public static function sortLargestTotalPower(self $alpha, self $bravo): int
    {
        return $bravo->totalPower() <=> $alpha->totalPower();
    }

    private function __construct(private array $cells, public string $id)
    {
    }

    public function totalPower(): int
    {
        return array_sum(array_map(static fn (FuelCell $cell) => $cell->powerLevel(), $this->cells));
    }
}
