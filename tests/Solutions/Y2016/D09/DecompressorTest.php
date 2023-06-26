<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D09;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

final class DecompressorTest extends TestCase
{
    #[DataProviderExternal(DecompressorDataProvider::class, 'v1')]
    public function testDecompress(string $input, string $expected): void
    {
        $actual = Decompressor::decompress($input, Format::V1);

        self::assertSame($expected, $actual);
    }

    #[DataProviderExternal(DecompressorDataProvider::class, 'v2')]
    public function testDecompressV2(string $input, int $expected): void
    {
        $actual = strlen(Decompressor::decompress($input, Format::V2));

        self::assertSame($expected, $actual);
    }
}
