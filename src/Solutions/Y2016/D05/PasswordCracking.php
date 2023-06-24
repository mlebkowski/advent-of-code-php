<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D05;

use App\Aoc\Progress\Progress;
use loophp\collection\Collection;

final class PasswordCracking
{
    private const MagicPrefix = '00000';

    public static function of(string $input, Progress $progress, Password $password): string
    {
        return Collection::fromGenerator(Integers::all())
            ->apply($progress->step(...))
            ->map(static fn (int $k) => md5($input . $k))
            ->apply(static fn (string $hash) => $progress->report($password->progress($hash)))
            ->filter(static fn (string $hash) => str_starts_with($hash, self::MagicPrefix))
            ->map(static fn (string $hash) => substr($hash, strlen(self::MagicPrefix)))
            ->map($password->update(...))
            ->find(
                default: '********',
                callbacks: static fn (string $password) => false === str_contains($password, '*'),
            );
    }
}
