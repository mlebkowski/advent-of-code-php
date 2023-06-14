<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D16;

enum Attribute: string
{
    case Children = 'children';
    case Cats = 'cats';
    case Samoyeds = 'samoyeds';
    case Pomeranians = 'pomeranians';
    case Akitas = 'akitas';
    case Vizslas = 'vizslas';
    case Goldfish = 'goldfish';
    case Trees = 'trees';
    case Cars = 'cars';
    case Perfumes = 'perfumes';
}
