<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Evolution;

use App\Realms\RolePlaying\Combat\Combat;
use App\Realms\RolePlaying\Magic\Spell;
use App\Realms\RolePlaying\WizardBuilder;
use loophp\collection\Collection;
use Stringable;

final readonly class SpeciesResult implements Stringable
{
    public static function of(Context $context, Species $species): self
    {
        $player = WizardBuilder::start($species->name, $context->hitPoints, $context->mana)
            ->withSpells(...$species->spells)
            ->build();

        $spellCount = count($species->spells);
        $enemy = $context->enemy();
        $originalHitPoints = $enemy->hitPoints();
        $combat = Combat::ofCharacters($player, $enemy, $context->effect);
        $turns = (int)ceil(count(iterator_to_array($combat)) / 2);
        $winner = $player->isAlive();
        $damageDealt = min($originalHitPoints, $originalHitPoints - $enemy->hitPoints()) + $player->hitPoints();

        $manaSpent = Collection::range(0, $turns)
            ->map(static fn (float $roundNo) => $species->spells[$roundNo % $spellCount])
            ->map(static fn (Spell $spell) => $spell->cost)
            ->reduce(static fn (int $sum, int $cost) => $sum + $cost, 0);

        return new self($species, $winner, $turns, $manaSpent, $damageDealt, $player->hitPoints());
    }

    public static function compare(self $alpha, self $bravo): int
    {
        // if we did not manage to win, greatest damage is the closes to a win
        if (false === $bravo->winner) {
            return $bravo->damageDealt <=> $alpha->damageDealt
                ?: $alpha->manaSpent <=> $bravo->manaSpent;
        }

        // use the least mana spent:
        return $alpha->manaSpent <=> $bravo->manaSpent;
    }

    private function __construct(
        public Species $species,
        public bool $winner,
        public int $turns,
        public int $manaSpent,
        public int $damageDealt,
        public int $hp,
    ) {
    }

    public function __toString()
    {
        return sprintf(
            '%s (%s, dmg: %d, turns: %d, mana: %d, hp: %d)',
            $this->species->name,
            $this->winner ? 'winner' : 'loser',
            $this->damageDealt,
            $this->turns,
            $this->manaSpent,
            $this->hp,
        );
    }
}
