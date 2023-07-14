<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D16\Testers;

use App\Solutions\Y2018\D16\Instructions\D16Instruction;
use App\Solutions\Y2018\D16\Instructions\Factory\InstructionFactory;
use App\Solutions\Y2018\D16\Observation;

final class ObservationTester
{
    public static function count(Observation $observation): int
    {
        return count(array_filter(self::test($observation)));
    }

    public static function test(Observation $observation): array
    {
        return [
            'addi' => self::testInstruction($observation, InstructionFactory::tryAddi($observation->operation)),
            'addr' => self::testInstruction($observation, InstructionFactory::tryAddr($observation->operation)),
            'bani' => self::testInstruction($observation, InstructionFactory::tryBani($observation->operation)),
            'banr' => self::testInstruction($observation, InstructionFactory::tryBanr($observation->operation)),
            'bori' => self::testInstruction($observation, InstructionFactory::tryBori($observation->operation)),
            'borr' => self::testInstruction($observation, InstructionFactory::tryBorr($observation->operation)),
            'eqir' => self::testInstruction($observation, InstructionFactory::tryEqir($observation->operation)),
            'eqri' => self::testInstruction($observation, InstructionFactory::tryEqri($observation->operation)),
            'eqrr' => self::testInstruction($observation, InstructionFactory::tryEqrr($observation->operation)),
            'gtir' => self::testInstruction($observation, InstructionFactory::tryGtir($observation->operation)),
            'gtri' => self::testInstruction($observation, InstructionFactory::tryGtri($observation->operation)),
            'gtrr' => self::testInstruction($observation, InstructionFactory::tryGtrr($observation->operation)),
            'muli' => self::testInstruction($observation, InstructionFactory::tryMuli($observation->operation)),
            'mulr' => self::testInstruction($observation, InstructionFactory::tryMulr($observation->operation)),
            'seti' => self::testInstruction($observation, InstructionFactory::trySeti($observation->operation)),
            'setr' => self::testInstruction($observation, InstructionFactory::trySetr($observation->operation)),
        ];
    }

    private static function testInstruction(Observation $observation, ?D16Instruction $instruction): bool
    {
        return $instruction?->call($observation->before)?->equals($observation->after);
    }
}
