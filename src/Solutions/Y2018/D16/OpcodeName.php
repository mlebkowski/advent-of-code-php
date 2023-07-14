<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D16;

enum OpcodeName: string
{
    case Addi = 'addi';
    case Addr = 'addr';
    case Bani = 'bani';
    case Banr = 'banr';
    case Bori = 'bori';
    case Borr = 'borr';
    case Eqir = 'eqir';
    case Eqri = 'eqri';
    case Eqrr = 'eqrr';
    case Gtir = 'gtir';
    case Gtri = 'gtri';
    case Gtrr = 'gtrr';
    case Muli = 'muli';
    case Mulr = 'mulr';
    case Seti = 'seti';
    case Setr = 'setr';
}
