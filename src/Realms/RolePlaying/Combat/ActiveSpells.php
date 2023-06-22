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
    /** @var ActiveSpell[] */
    private array $spells = [];

    /** @var ActiveSpell[] */
    private array $exhausted = [];

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
        $activeSpellsBySameName = Collection::fromIterable($this->spells)
            ->filter(static fn (ActiveSpell $active) => $active->hasSameEffectAs($sorcery))
            ->count();

        NoDuplicateEffects::whenAlreadyActive($activeSpellsBySameName > 0, $sorcery);
        $this->spells[] = ActiveSpell::of($sorcery, $character);
    }

    public function apply(Character ...$players): void
    {
        foreach ($this->exhausted as $spell) {
            $spell->wearOff();
        }
        $this->exhausted = [];

        foreach ($this->spells as $spell) {
            $spell->apply(...$players);
        }

        $isExhausted = static fn (ActiveSpell $spell) => $spell->isExhausted();
        $this->exhausted = Collection::fromIterable($this->spells)->filter($isExhausted)->all();
        $this->spells = Collection::fromIterable($this->spells)->reject($isExhausted)->all();
    }
}
