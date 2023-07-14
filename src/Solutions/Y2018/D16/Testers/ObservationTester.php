<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D16\Testers;

use App\Lib\Type\Cast;
use App\Solutions\Y2018\D16\Instructions\Factory\InstructionFactory;
use App\Solutions\Y2018\D16\Observation;
use App\Solutions\Y2018\D16\OpcodeName;
use loophp\collection\Collection;
use ValueError;

final class ObservationTester
{
    public static function count(Observation $observation): int
    {
        return count(self::getMatchingOpcodeNames($observation));
    }

    public static function getMatchingOpcodeNames(Observation $observation): array
    {
        return Collection::fromIterable(OpcodeName::cases())
            ->filter(static fn (OpcodeName $opcodeName) => self::testInstruction($opcodeName, $observation))
            ->map(Cast::toEnumValue(...))
            ->all();
    }

    private static function testInstruction(OpcodeName $name, Observation $observation): bool
    {
        try {
            $instruction = InstructionFactory::named($name, $observation->operation);
        } catch (ValueError) {
            return false;
        }

        return $instruction->call($observation->before)->equals($observation->after);
    }
}
