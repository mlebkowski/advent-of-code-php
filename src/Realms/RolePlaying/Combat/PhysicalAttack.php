<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Combat;

use App\Realms\RolePlaying\Character;
use Stringable;

final readonly class PhysicalAttack implements Stringable
{
    public static function of(Character $attacker, Character $defender): self
    {
        $damage = max(1, $attacker->attack - $defender->armor());
        $defender->reduceHitPoints($damage);
        return new self($attacker, $defender, $damage, $defender->hitPoints());
    }

    private function __construct(
        private Character $attacker,
        private Character $defender,
        private int $damage,
        private int $hp,
    ) {
    }

    public function __toString(): string
    {
        return sprintf(
            'The %s deals %d-%d = %d damage; the %s goes down to %d hit points.',
            $this->attacker,
            $this->attacker->attack,
            $this->defender->armor(),
            $this->damage,
            $this->defender,
            $this->hp,
        );
    }
}
