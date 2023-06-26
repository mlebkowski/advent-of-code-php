<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D07;

use loophp\collection\Collection;

final readonly class Ipv7
{
    public static function of(array $supernetSequences, array $hypernetSequences): self
    {
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

    public function supportsSuperSecretListening(): bool
    {
        $abas = Collection::fromIterable($this->supernetSequences)
            ->flatMap(AreaBroadcastAccessor::in(...));

        if ($abas->isEmpty()) {
            return false;
        }

        $candidates = $abas
            ->map(static fn (AreaBroadcastAccessor $aba) => static fn (string $sequence) => str_contains(
                $sequence,
                (string)$aba->toByteAllocationBlock(),
            ));

        return Collection::fromIterable($this->hypernetSequences)->filter(...$candidates)->isNotEmpty();
    }
}
