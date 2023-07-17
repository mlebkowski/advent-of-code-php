<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D18;

enum Acre: string
{
    case OpenGround = '.';
    case Trees = '|';
    case Lumberyard = '#';

    public function convert(array $neighbours): self
    {
        $neighbours += [
            self::OpenGround->value => 0,
            self::Trees->value => 0,
            self::Lumberyard->value => 0,
        ];

        return match ($this) {
            self::OpenGround => $neighbours[self::Trees->value] >= 3 ? self::Trees : self::OpenGround,
            self::Trees => $neighbours[self::Lumberyard->value] >= 3 ? self::Lumberyard : self::Trees,
            self::Lumberyard => $neighbours[self::Lumberyard->value] >= 1
            && $neighbours[self::Trees->value] >= 1 ? self::Lumberyard : self::OpenGround,
        };
    }
}
