<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D07;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

final class Ipv7Test extends TestCase
{
    public function test from string(): void
    {
        $given = 'ctdohoakygysybf'
            . '[loxbfdhctlnhggxpoq]'
            . 'bimosyslpbihbwqp'
            . '[fahhvvdfkiiucdf]'
            . 'bbgugrcsmoasoxyymgz'
            . '[wjhbkirawxanrqf]'
            . 'palckvdfnlhficazmwm';
        $actual = Ipv7::fromString($given);

        self::assertSame(
            [
                'ctdohoakygysybf',
                'bimosyslpbihbwqp',
                'bbgugrcsmoasoxyymgz',
                'palckvdfnlhficazmwm',
            ],
            $actual->supernetSequences,
        );
        self::assertSame(
            [
                'loxbfdhctlnhggxpoq',
                'fahhvvdfkiiucdf',
                'wjhbkirawxanrqf',
            ],
            $actual->hypernetSequences,
        );
    }

    #[DataProviderExternal(AbbaDataProvider::class, 'data')]
    public function test tls(string $address, bool $expected): void
    {
        $sut = Ipv7::fromString($address);
        $actual = $sut->supportsTransportLayerSnooping();
        self::assertSame($expected, $actual);
    }
}
