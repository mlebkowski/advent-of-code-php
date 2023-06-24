<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D04;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use loophp\collection\Collection;

/** @implements Solution<SecurityThroughObscurityInput> */
final class SecurityThroughObscurity implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2016, 04);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $validRooms = Collection::fromIterable($input->rooms)
            ->filter(static fn (Room $room) => $room->isValid());

        if ($challenge->isPartOne()) {
            return $validRooms
                ->map(static fn (Room $room) => $room->sectorId)
                ->reduce(static fn (int $sum, int $sectorId) => $sum + $sectorId, 0);
        }

        return $validRooms
            ->find(callbacks: static fn (Room $room) => "northpole object storage" === $room->decryptedName())
            ->sectorId;
    }
}
