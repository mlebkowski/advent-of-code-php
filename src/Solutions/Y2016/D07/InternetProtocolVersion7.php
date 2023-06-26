<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D07;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use loophp\collection\Collection;

/** @implements Solution<InternetProtocolVersion7Input> */
final class InternetProtocolVersion7 implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2016, 07);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $check = $challenge->isPartOne()
            ? static fn (Ipv7 $ipv7) => $ipv7->supportsTransportLayerSnooping()
            : static fn (Ipv7 $ipv7) => $ipv7->supportsSuperSecretListening();
        
        return Collection::fromIterable($input->addresses)->filter($check)->count();
    }
}
