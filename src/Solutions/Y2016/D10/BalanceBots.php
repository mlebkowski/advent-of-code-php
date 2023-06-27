<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D10;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use loophp\collection\Collection;
use RuntimeException;

/** @implements Solution<BalanceBotsInput> */
final class BalanceBots implements Solution
{
    private const Low = 17;
    private const High = 61;

    public function challenges(): iterable
    {
        return Challenge::bothParts(2016, 10);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): int
    {
        $low = $runMode->isSample() ? 2 : self::Low;
        $high = $runMode->isSample() ? 5 : self::High;

        $factory = MicrochipFactory::ofInitialDisposition($input->rules, $input->values);
        $process = Collection::fromGenerator($factory->run());

        if ($challenge->isPartTwo()) {
            $process->squash();
            return $factory->value();
        }

        return $process->find(
            callbacks: static fn (TransferOut $transfer) => $transfer->matches($low, $high),
        )
            ->botId ?? throw new RuntimeException('No such transfer occured');
    }
}
