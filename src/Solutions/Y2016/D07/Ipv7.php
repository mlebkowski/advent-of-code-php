<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D07;

use loophp\collection\Collection;

final readonly class Ipv7
{
    public static function fromString(string $address): self
    {
        $hypernetSequenceRe = '/\[(?P<hypernetSequence>\w+)]/';
        preg_match_all($hypernetSequenceRe, $address, $matches);
        $supernetSequences = preg_split($hypernetSequenceRe, $address);
        $hypernetSequences = $matches['hypernetSequence'];
        return new self($supernetSequences, $hypernetSequences);
    }

    private function __construct(public array $supernetSequences, public array $hypernetSequences)
    {
    }

    public function supportsTransportLayerSnooping(): bool
    {
        $abbaRe = '/(.)(?!\1)(.)\2\1/';
        $containsAbba = static fn (string $value) => 1 === preg_match($abbaRe, $value);

        return Collection::fromIterable($this->supernetSequences)->filter($containsAbba)->isNotEmpty()
            && Collection::fromIterable($this->hypernetSequences)->filter($containsAbba)->isEmpty();
    }
}
