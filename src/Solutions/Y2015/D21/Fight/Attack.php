<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D21\Fight;

use App\Solutions\Y2015\D21\Character;
use Stringable;

final readonly class Attack implements Stringable
{
    public static function of(Character $attacker, Character $defender): self
    {
        $hp = $defender->hitPoints();
        $attack = $attacker->attack;
        $defender->receiveAttack($attack);
        $damage = $hp - $defender->hitPoints();
        $armor = $attack - $damage;

        return new self($attacker, $defender, $armor, $damage, $defender->hitPoints());
    }

    private function __construct(
        private Character $attacker,
        private Character $defender,
        private int $armor,
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
            $this->armor,
            $this->damage,
            $this->defender,
            $this->hp,
        );
    }
}
