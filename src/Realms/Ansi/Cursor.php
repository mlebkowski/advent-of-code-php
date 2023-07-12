<?php
declare(strict_types=1);

namespace App\Realms\Ansi;

enum Cursor: string
{
    case Hide = "\033[?25l";
    case Restore = "\033[?25h";
    case Up = "\033[%dA";
    case Down = "\033[%dB";
    case Right = "\033[%dC";
    case Left = "\033[%dD";
}
