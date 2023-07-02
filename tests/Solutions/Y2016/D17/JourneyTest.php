<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D17;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

final class JourneyTest extends TestCase
{
    #[DataProviderExternal(JourneyDataProvider::class, 'shortest')]
    public function test shortest path(string $passcode, string $expectedPath)
    {
        $given = Environment::of(width: 4, height: 4, passcode: $passcode);
        $actual = Journey::shortestPathToVault($given);
        self::assertSame($expectedPath, (string)$actual);
    }

    #[DataProviderExternal(JourneyDataProvider::class, 'longest')]
    public function test longest length(string $passcode, int $expectedLength)
    {
        $this->markTestIncomplete('Takes too loong to execute');
        $given = Environment::of(width: 4, height: 4, passcode: $passcode);
        $actual = Journey::longestPathToVaultLength($given);
        self::assertSame($expectedLength, $actual);
    }
}
