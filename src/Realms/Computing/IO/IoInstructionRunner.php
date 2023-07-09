<?php
declare(strict_types=1);

namespace App\Realms\Computing\IO;

use App\Realms\Computing\Instruction\Instruction;
use App\Realms\Computing\IO\Problems\ReadWait;
use App\Realms\Computing\Processor\Processor;

final readonly class IoInstructionRunner
{
    public static function run(Instruction $instruction, Processor $processor): iterable
    {
        try {
            $instruction->apply($processor);
        } catch (ReadWait $readWait) {
            yield $readWait;

            try {
                $instruction->apply($processor);
            } catch (ReadWait) {
                $processor->halt();
            }
        }
    }
}
