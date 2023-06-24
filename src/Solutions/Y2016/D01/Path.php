<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D01;

use App\Solutions\Y2016\D01\Input\Instruction;

final readonly class Path
{
    public Point $firstIntersection;
    public Point $lastPosition;

    public static function of(Instruction ...$instructions): self
    {
        $position = Point::center();
        $orientation = Orientation::North;
        $points = [];
        foreach ($instructions as $instruction) {
            $orientation = $orientation->turn($instruction->turn);
            $lineSegment = $position->lineSegment($orientation, $instruction->distance);
            $points = array_merge($points, $lineSegment->rest());
            $position = $lineSegment->end();
        }

        return new self($points);
    }

    public function __construct(public array $points)
    {
        $places = [];
        foreach ($points as $point) {
            $key = (string)$point;
            if (isset($places[$key]) && false === isset($this->firstIntersection)) {
                $this->firstIntersection = $point;
            }
            $places[$key] = true;
        }
        $this->lastPosition = end($points);
    }
}
