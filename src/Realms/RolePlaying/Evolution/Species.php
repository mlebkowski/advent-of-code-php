<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Evolution;

use App\Realms\RolePlaying\Magic\Spell;
use App\Realms\RolePlaying\Magic\SpellFactory;
use loophp\collection\Collection;

final readonly class Species
{
    private const MaxSpells = 24;

    public static function of(Spell ...$spells): self
    {
        $name = Collection::fromIterable($spells)
            ->map(static fn (Spell $spell) => $spell->name[0])
            ->implode();
        return new self($name, $spells);
    }

    private function __construct(public string $name, public array $spells)
    {
        if (false === (count($this->spells) <= self::MaxSpells)) {
            var_dump(count($this->spells));
        }
        assert(count($this->spells) <= self::MaxSpells);
    }

    public function mutateIfNotBest(bool $isBest, int $maxSpells): self
    {
        return $isBest ? $this : $this->mutate($maxSpells);
    }

    private function mutate(int $maxSpells): self
    {
        $random = rand(1, 100);

        return match (true) {
            $random < 2 => $this->withRandomMutations(rand(1, 3)),
            $random < 4 => $this->withRandomMutations(rand(4, 6)),
            $random < 35 => $this->withoutRandomSpell(),
            $random < 60 => $this->withReplacedSpell(),
            default => $this->withAdditionalSpell($maxSpells),
        };
    }

    private function withRandomMutations(int $count): self
    {
        return Collection::range(0, $count)
            ->reduce(static fn (self $species) => $species->withReplacedSpell(), $this);
    }

    private function withAdditionalSpell(int $maxSpells): Species
    {
        if (count($this->spells) >= min($maxSpells, self::MaxSpells)) {
            return $this;
        }

        $spells = $this->spells;
        $spells[] = self::randomSpell();
        return self::of(...$spells);
    }

    private function withoutRandomSpell(): Species
    {
        if (count($this->spells) <= 2) {
            return $this;
        }

        $randomIndex = rand(0, count($this->spells));
        $spells = array_diff_key($this->spells, [$randomIndex => true]);
        return self::of(...$spells);
    }

    private function withReplacedSpell(): Species
    {
        $randomIndex = rand(0, count($this->spells) - 1);
        return self::of(...[$randomIndex => self::randomSpell()] + $this->spells);
    }

    private static function randomSpell(): Spell
    {
        $all = iterator_to_array(SpellFactory::all());
        $index = rand(0, count($all) - 1);
        return $all[$index];
    }
}
