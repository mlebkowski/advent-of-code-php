<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D25;

use App\Aoc\Progress\Progress;
use App\Realms\Computing\Instruction\Instruction;
use App\Realms\Computing\Processor\Processor;
use App\Realms\Computing\Processor\Register;
use loophp\collection\Collection;

final class SeedFinder
{
    private const SampleSize = 15;

    public static function find(Progress $progress, Instruction ...$instructions): int
    {
        $expectedSignal = str_repeat('01', self::SampleSize);
        $i = 0;
        while (true) {
            $processor = Processor::ofInstructions(...$instructions);
            $processor->setRegister(Register::A, $i);

            $signal = self::getSignal($processor);
            $progress->iterate($signal);

            if ($expectedSignal === $signal) {
                return $i;
            }

            $i++;
        }
    }

    private static function getSignal(Processor $processor): string
    {
        return Collection::fromGenerator($processor->start())
            ->slice(0, self::SampleSize * 2)
            ->map(static fn (mixed $value) => (string)$value)
            ->implode();
    }
}
