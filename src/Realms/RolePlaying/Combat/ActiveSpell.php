<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Combat;

use App\Realms\RolePlaying\Character;
use App\Realms\RolePlaying\Combat\Problems\CannotApplyEffect;
use App\Realms\RolePlaying\Magic\Cleanup\Cleanup;
use App\Realms\RolePlaying\Magic\Sorcery;
use Generator;
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

    /**
     * @throws CannotApplyEffect
     */
    public function apply(Character ...$characters): Generator
    {
        CannotApplyEffect::whenSorceryExhausted($this->isExhausted(), $this->sorcery);

        $this->iteration++;

        $opponents = Collection::fromIterable($characters)
            ->reject(fn (Character $character) => $character === $this->wizard);

        if ($this->cleanup) {
            return;
        }

        $this->cleanup = $this->sorcery->effect->apply($this->wizard, ...$opponents);
        yield SpellEffect::ofEffect(
            $this->sorcery->name,
            $this->sorcery->effect,
            $this->sorcery->duration - $this->iteration,
        );
    }

    public function wearOff(): Generator
    {
        if (!$this->cleanup) {
            return;
        }

        $this->cleanup->apply();
        yield SpellEffect::ofWearOff($this->sorcery->name, $this->cleanup);
    }
}
