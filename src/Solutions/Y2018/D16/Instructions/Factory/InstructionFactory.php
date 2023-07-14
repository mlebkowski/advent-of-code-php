<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D16\Instructions\Factory;

use App\Solutions\Y2018\D16\D16Register;
use App\Solutions\Y2018\D16\InstructionCall;
use App\Solutions\Y2018\D16\Instructions\Addi;
use App\Solutions\Y2018\D16\Instructions\Addr;
use App\Solutions\Y2018\D16\Instructions\Bani;
use App\Solutions\Y2018\D16\Instructions\Banr;
use App\Solutions\Y2018\D16\Instructions\Bori;
use App\Solutions\Y2018\D16\Instructions\Borr;
use App\Solutions\Y2018\D16\Instructions\Eqir;
use App\Solutions\Y2018\D16\Instructions\Eqri;
use App\Solutions\Y2018\D16\Instructions\Eqrr;
use App\Solutions\Y2018\D16\Instructions\Gtir;
use App\Solutions\Y2018\D16\Instructions\Gtri;
use App\Solutions\Y2018\D16\Instructions\Gtrr;
use App\Solutions\Y2018\D16\Instructions\Muli;
use App\Solutions\Y2018\D16\Instructions\Mulr;
use App\Solutions\Y2018\D16\Instructions\Seti;
use App\Solutions\Y2018\D16\Instructions\Setr;
use ValueError;

final class InstructionFactory
{
    public static function addi(InstructionCall $call): Addi
    {
        return Addi::of(D16Register::from($call->alpha), $call->bravo, $call->target);
    }

    public static function tryAddi(InstructionCall $call): ?Addi
    {
        try {
            return self::addi($call);
        } catch (ValueError) {
            return null;
        }
    }

    public static function addr(InstructionCall $call): Addr
    {
        return Addr::of(D16Register::from($call->alpha), D16Register::from($call->bravo), $call->target);
    }

    public static function tryAddr(InstructionCall $call): ?Addr
    {
        try {
            return self::addr($call);
        } catch (ValueError) {
            return null;
        }
    }

    public static function bani(InstructionCall $call): Bani
    {
        return Bani::of(D16Register::from($call->alpha), $call->bravo, $call->target);
    }

    public static function tryBani(InstructionCall $call): ?Bani
    {
        try {
            return self::bani($call);
        } catch (ValueError) {
            return null;
        }
    }

    public static function banr(InstructionCall $call): Banr
    {
        return Banr::of(D16Register::from($call->alpha), D16Register::from($call->bravo), $call->target);
    }

    public static function tryBanr(InstructionCall $call): ?Banr
    {
        try {
            return self::banr($call);
        } catch (ValueError) {
            return null;
        }
    }

    public static function bori(InstructionCall $call): Bori
    {
        return Bori::of(D16Register::from($call->alpha), $call->bravo, $call->target);
    }

    public static function tryBori(InstructionCall $call): ?Bori
    {
        try {
            return self::bori($call);
        } catch (ValueError) {
            return null;
        }
    }

    public static function borr(InstructionCall $call): Borr
    {
        return Borr::of(D16Register::from($call->alpha), D16Register::from($call->bravo), $call->target);
    }

    public static function tryBorr(InstructionCall $call): ?Borr
    {
        try {
            return self::borr($call);
        } catch (ValueError) {
            return null;
        }
    }

    public static function eqir(InstructionCall $call): Eqir
    {
        return Eqir::of($call->alpha, D16Register::from($call->bravo), $call->target);
    }

    public static function tryEqir(InstructionCall $call): ?Eqir
    {
        try {
            return self::eqir($call);
        } catch (ValueError) {
            return null;
        }
    }

    public static function eqri(InstructionCall $call): Eqri
    {
        return Eqri::of(D16Register::from($call->alpha), $call->bravo, $call->target);
    }

    public static function tryEqri(InstructionCall $call): ?Eqri
    {
        try {
            return self::eqri($call);
        } catch (ValueError) {
            return null;
        }
    }

    public static function eqrr(InstructionCall $call): Eqrr
    {
        return Eqrr::of(D16Register::from($call->alpha), D16Register::from($call->bravo), $call->target);
    }

    public static function tryEqrr(InstructionCall $call): ?Eqrr
    {
        try {
            return self::eqrr($call);
        } catch (ValueError) {
            return null;
        }
    }

    public static function gtir(InstructionCall $call): Gtir
    {
        return Gtir::of($call->alpha, D16Register::from($call->bravo), $call->target);
    }

    public static function tryGtir(InstructionCall $call): ?Gtir
    {
        try {
            return self::gtir($call);
        } catch (ValueError) {
            return null;
        }
    }

    public static function gtri(InstructionCall $call): Gtri
    {
        return Gtri::of(D16Register::from($call->alpha), $call->bravo, $call->target);
    }

    public static function tryGtri(InstructionCall $call): ?Gtri
    {
        try {
            return self::gtri($call);
        } catch (ValueError) {
            return null;
        }
    }

    public static function gtrr(InstructionCall $call): Gtrr
    {
        return Gtrr::of(D16Register::from($call->alpha), D16Register::from($call->bravo), $call->target);
    }

    public static function tryGtrr(InstructionCall $call): ?Gtrr
    {
        try {
            return self::gtrr($call);
        } catch (ValueError) {
            return null;
        }
    }

    public static function muli(InstructionCall $call): Muli
    {
        return Muli::of(D16Register::from($call->alpha), $call->bravo, $call->target);
    }

    public static function tryMuli(InstructionCall $call): ?Muli
    {
        try {
            return self::muli($call);
        } catch (ValueError) {
            return null;
        }
    }

    public static function mulr(InstructionCall $call): Mulr
    {
        return Mulr::of(D16Register::from($call->alpha), D16Register::from($call->bravo), $call->target);
    }

    public static function tryMulr(InstructionCall $call): ?Mulr
    {
        try {
            return self::mulr($call);
        } catch (ValueError) {
            return null;
        }
    }

    public static function seti(InstructionCall $call): Seti
    {
        return Seti::of($call->alpha, $call->target);
    }

    public static function trySeti(InstructionCall $call): ?Seti
    {
        try {
            return self::seti($call);
        } catch (ValueError) {
            return null;
        }
    }

    public static function setr(InstructionCall $call): Setr
    {
        return Setr::of(D16Register::from($call->alpha), $call->target);
    }

    public static function trySetr(InstructionCall $call): ?Setr
    {
        try {
            return self::setr($call);
        } catch (ValueError) {
            return null;
        }
    }

}
