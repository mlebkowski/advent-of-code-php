<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D16;

use App\Lib\Type\Cast;
use App\Solutions\Y2018\D16\Instructions\D16Instruction;
use App\Solutions\Y2018\D16\Instructions\Factory\InstructionFactory;
use App\Solutions\Y2018\D16\Testers\ObservationTester;
use loophp\collection\Collection;

final readonly class OpcodeResolver
{
    public static function of(Observation ...$observations): self
    {
        $allNames = array_map(Cast::toEnumValue(...), OpcodeName::cases());
        $result = Collection::fromIterable(Opcode::cases())
            ->map(static fn (Opcode $opcode) => [$opcode->value, $allNames])
            ->unpack()
            ->all(false);

        foreach ($observations as $observation) {
            $opcode = $observation->operation->opcode->value;
            $possibilities = $result[$opcode];
            $result[$opcode] = array_intersect(
                $possibilities,
                ObservationTester::getMatchingOpcodeNames($observation),
            );
        }

        $result = UniqueMapping::deduce($result);

        return new self($result);
    }

    private function __construct(private array $map)
    {
    }

    public function resolve(InstructionCall $call): D16Instruction
    {
        $opcodeName = $this->map[$call->opcode->value];
        return InstructionFactory::named($opcodeName, $call);
    }

}
