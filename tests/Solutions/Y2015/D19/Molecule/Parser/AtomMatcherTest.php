<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule\Parser;

use App\Solutions\Y2015\D19\Molecule\ChemistryMother;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

final class AtomMatcherTest extends TestCase
{
    #[DataProviderExternal(AtomMatcherDataProvider::class, 'data')]
    public function test match(string $molecule, string $expected): void
    {
        $sut = new AtomMatcher(ChemistryMother::some());
        $actual = $sut->match($molecule);
        self::assertSame($expected, implode(', ', $actual));
    }
}
