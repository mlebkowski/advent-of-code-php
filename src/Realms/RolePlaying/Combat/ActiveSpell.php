<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Combat;

use App\Realms\RolePlaying\Character;
use App\Realms\RolePlaying\Magic\Cleanup\Cleanup;
use App\Realms\RolePlaying\Magic\Sorcery;
use loophp\collection\Collection;

final class ActiveSpell
{
    private int $iteration = 0;
    private ?Cleanup $cleanup = null;

    public static function of(Sorcery $sorcery, Character $wizard): self
    {
        return new self($sorcery, $wizard);
    }

    private function __construct(private readonly Sorcery $sorcery, private readonly Character $wizard)
    {
    }

    public function hasSameEffectAs(Sorcery $spell): bool
    {
        return $this->sorcery->name === $spell->name;
    }

    public function isExhausted(): bool
    {
        return $this->iteration >= $this->sorcery->duration;
    }

    public function apply(Character ...$characters): void
    {
        $opponents = Collection::fromIterable($characters)
            ->reject(fn (Character $character) => $character === $this->wizard);
        $this->iteration++;

        $this->cleanup ??= $this->sorcery->effect->apply($this->wizard, ...$opponents);
    }

    public function wearOff(): void
    {
        $this->cleanup?->apply();
    }
}
