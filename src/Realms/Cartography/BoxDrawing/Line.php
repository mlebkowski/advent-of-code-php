<?php
declare(strict_types=1);

namespace App\Realms\Cartography\BoxDrawing;

enum Line: string
{
    case Vertical = '│';
    case HalfTop = '╵';
    case HalfRight = '╶';
    case HalfBottom = '╷';
    case HalfLeft = '╴';
    case Horizontal = '─';
    case Intersection = '┼';
    case CornerTopLeft = '┌';
    case CornerTopRight = '┐';
    case CornerBottomLeft = '└';
    case CornerBottomRight = '┘';
}
