<?php
declare(strict_types=1);

namespace App\Realms\Ansi;

enum Colors: string
{
    case Black = "\033[30m";
    case Red = "\033[31m";
    case Green = "\033[32m";
    case Yellow = "\033[33m";
    case Blue = "\033[34m";
    case Purple = "\033[35m";
    case Cyan = "\033[36m";
    case White = "\033[37m";
    case BlackBackground = "\033[40m";
    case RedBackground = "\033[41m";
    case GreenBackground = "\033[42m";
    case YellowBackground = "\033[43m";
    case BlueBackground = "\033[44m";
    case PurpleBackground = "\033[45m";
    case CyanBackground = "\033[46m";
    case WhiteBackground = "\033[47m";
    case Reset = "\033[0m";
}
