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
use App\Solutions\Y2018\D16\Instructions\D16Instruction;
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
use App\Solutions\Y2018\D16\OpcodeName;

final class InstructionFactory
{
    public static function named(OpcodeName $name, InstructionCall $call): ?D16Instruction
    {
        return match ($name) {
            OpcodeName::Addi => Addi::of(D16Register::from($call->alpha), $call->bravo, $call->target),
            OpcodeName::Addr => Addr::of(D16Register::from($call->alpha), D16Register::from($call->bravo), $call->target),
            OpcodeName::Bani => Bani::of(D16Register::from($call->alpha), $call->bravo, $call->target),
            OpcodeName::Banr => Banr::of(D16Register::from($call->alpha), D16Register::from($call->bravo), $call->target),
            OpcodeName::Bori => Bori::of(D16Register::from($call->alpha), $call->bravo, $call->target),
            OpcodeName::Borr => Borr::of(D16Register::from($call->alpha), D16Register::from($call->bravo), $call->target),
            OpcodeName::Eqir => Eqir::of($call->alpha, D16Register::from($call->bravo), $call->target),
            OpcodeName::Eqri => Eqri::of(D16Register::from($call->alpha), $call->bravo, $call->target),
            OpcodeName::Eqrr => Eqrr::of(D16Register::from($call->alpha), D16Register::from($call->bravo), $call->target),
            OpcodeName::Gtir => Gtir::of($call->alpha, D16Register::from($call->bravo), $call->target),
            OpcodeName::Gtri => Gtri::of(D16Register::from($call->alpha), $call->bravo, $call->target),
            OpcodeName::Gtrr => Gtrr::of(D16Register::from($call->alpha), D16Register::from($call->bravo), $call->target),
            OpcodeName::Muli => Muli::of(D16Register::from($call->alpha), $call->bravo, $call->target),
            OpcodeName::Mulr => Mulr::of(D16Register::from($call->alpha), D16Register::from($call->bravo), $call->target),
            OpcodeName::Seti => Seti::of($call->alpha, $call->target),
            OpcodeName::Setr => Setr::of(D16Register::from($call->alpha), $call->target),
        };
    }
}
