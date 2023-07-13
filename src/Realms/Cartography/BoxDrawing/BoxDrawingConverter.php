<?php
declare(strict_types=1);

namespace App\Realms\Cartography\BoxDrawing;

final readonly class BoxDrawingConverter
{
    public static function fromPoorMansAscii(string $input): string
    {
        return strtr(
            $input,
            [
                '/-' => Line::CornerTopLeft->value . Line::Horizontal->value,
                '/+' => Line::CornerTopLeft->value . Line::Intersection->value,
                '\-' => Line::CornerBottomLeft->value . Line::Horizontal->value,
                '\+' => Line::CornerBottomLeft->value . Line::Intersection->value,
                '-/' => Line::Horizontal->value . Line::CornerBottomRight->value,
                '+/' => Line::Intersection->value . Line::CornerBottomRight->value,
                '-\\' => Line::Horizontal->value . Line::CornerTopRight->value,
                '+\\' => Line::Intersection->value . Line::CornerTopRight->value,
                '-' => Line::Horizontal->value,
                '|' => Line::Vertical->value,
                '+' => Line::Intersection->value,
            ],
        );
    }
}
