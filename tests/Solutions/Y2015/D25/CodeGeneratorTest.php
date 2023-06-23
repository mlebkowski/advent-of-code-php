<?php
declare(strict_types=1);

namespace App\Solutions\Y2015\D25;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\TestCase;

final class CodeGeneratorTest extends TestCase
{
    public function test generator(): void
    {
        self::assertSame(20151125, CodeGenerator::nth(0));
        self::assertSame(31916031, CodeGenerator::nth(1));
        self::assertSame(18749137, CodeGenerator::nth(2));
        self::assertSame(16080970, CodeGenerator::nth(3));
        self::assertSame(21629792, CodeGenerator::nth(4));
        self::assertSame(17289845, CodeGenerator::nth(5));
        self::assertSame(24592653, CodeGenerator::nth(6));
        self::assertSame(8057251, CodeGenerator::nth(7));
        self::assertSame(16929656, CodeGenerator::nth(8));
        self::assertSame(30943339, CodeGenerator::nth(9));
    }

    #[DataProviderExternal(CodeGeneratorDataProvider::class, 'data')]
    public function test at(int $row, int $column, int $expected): void
    {
        $actual = CodeGenerator::at($row, $column);
        self::assertSame($actual, $expected);
    }
}
