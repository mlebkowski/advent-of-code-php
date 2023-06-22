<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Combat;

use App\Realms\RolePlaying\Magic\Cleanup\Cleanup;
use App\Realms\RolePlaying\Magic\Effects\Effect;
use Stringable;

final readonly class SpellEffect implements Stringable
{
    public static function ofEffect(string $name, Effect $effect, int $timer): self
    {
        return new self("$name $effect; its timer is now $timer.");
    }

    public static function ofWearOff(string $name, Cleanup $cleanup): self
    {
        return new self("$name wears off, $cleanup.");
    }

    private function __construct(private string $message)
    {
    }

    public function __toString(): string
    {
        return $this->message;
    }
}
