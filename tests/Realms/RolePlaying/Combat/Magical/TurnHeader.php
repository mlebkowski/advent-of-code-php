<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Combat\Magical;

use App\Realms\RolePlaying\Character;
use Stringable;

final readonly class TurnHeader implements Stringable
{
    public static function of(Character $attacker, Character $player, Character $boss): self
    {
        $result[] = "-- $attacker turn --";
        $result[] = "- $player has {$player->hitPoints()} hit points,"
            . " {$player->armor()} armor, {$player->mana()} mana";
        $result[] = "- $boss has {$boss->hitPoints()} hit points";

        return new self(implode("\n", $result));
    }

    private function __construct(private string $message)
    {
    }

    public function __toString(): string
    {
        return $this->message;
    }
}
