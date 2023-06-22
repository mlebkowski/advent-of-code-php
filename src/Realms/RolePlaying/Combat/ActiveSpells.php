<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Combat;

use App\Realms\RolePlaying\Character;
use App\Realms\RolePlaying\Combat\Problems\NoDuplicateEffects;
use App\Realms\RolePlaying\Magic\Cleanup\Cleanup;
use App\Realms\RolePlaying\Magic\Sorcery;
use loophp\collection\Collection;

final class ActiveSpells
{
    /** @var ActiveSpells[] */
    private array $spells = [];

    /** @var Cleanup[] */
    private array $cleanup = [];

    public static function none(): self
    {
        return new self();
    }

    private function __construct()
    {
    }

    /**
     * @throws NoDuplicateEffects
     */
    public function add(Character $character, Sorcery $sorcery): void
    {
        $isSpellActive = 0 !== Collection::fromIterable($this->spells)
            ->filter(
                static fn (ActiveSpell $active) => $active->hasSameEffectAs($sorcery),
            )->count();

        NoDuplicateEffects::whenAlreadyActive($isSpellActive, $sorcery);
        $this->spells[] = ActiveSpell::of($sorcery, $character);
    }

    public function apply(Character ...$players): void
    {
        $this->cleanup = Collection::fromIterable($this->spells)
            ->map(static fn (ActiveSpell $spell) => $spell->apply(...$players))
            ->filter(static fn (?Cleanup $cleanup) => $cleanup)
            ->all();

        $this->spells = Collection::fromIterable($this->spells)
            ->reject(static fn (ActiveSpell $spell) => $spell->isExhausted())
            ->all();
    }

    public function wearOff(): void
    {
        foreach ($this->cleanup as $effect) {
            $effect->apply();
        }
    }
}
