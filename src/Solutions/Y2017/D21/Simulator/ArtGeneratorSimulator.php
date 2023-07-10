<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D21\Simulator;

use App\Realms\Cartography\Map;
use App\Solutions\Y2017\D21\ArtGenerator;
use App\Solutions\Y2017\D21\EnchancementRule;
use ArrayObject;

final readonly class ArtGeneratorSimulator
{
    private ArrayObject $memory;

    public static function of(Map $start, EnchancementRule ...$rules): self
    {
        return new self($start, ArtGenerator::of(...$rules));
    }

    private function __construct(private Map $start, private ArtGenerator $generator)
    {
        assert($this->start->width === $this->start->height);
        assert($this->start->width === 3);
        $this->memory = new ArrayObject();
    }

    public function afterIterations(int $iterations): int
    {
        assert($iterations % 3 === 0);
        $steps = $iterations / 3;

        $squares = [MapSquare::of($this->start)];
        while ($steps-- > 0) {
            $squares = iterator_to_array($this->multiply(...$squares), preserve_keys: false);
        }

        return array_reduce(
            $squares,
            static fn (int $sum, MapSquare $square) => $sum + $square->pixels,
            0,
        );
    }

    private function multiply(MapSquare ...$squares): iterable
    {
        foreach ($squares as $square) {
            yield from $this->multiplyOne($square);
        }
    }

    private function multiplyOne(MapSquare $square): iterable
    {
        if (isset($this->memory[$square->id])) {
            return $this->memory[$square->id];
        }

        $generator = $this->generator->enchance($square->map);
        $generator->next(); // skip 1
        $generator->next(); // skip 2
        $enchanced = $generator->current(); // get 3

        return $this->memory[$square->id] = MapSquare::fromTiles($enchanced);
    }
}
