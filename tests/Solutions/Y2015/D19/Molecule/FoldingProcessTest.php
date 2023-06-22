<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule;

use App\Solutions\Y2015\D19\Molecule\Parser\MoleculeParser;
use App\Solutions\Y2015\D19\Molecule\Parser\MoleculeParserTest;
use App\Solutions\Y2015\D19\Molecule\Parser\Pair;
use App\Solutions\Y2015\D19\NuclearMedicineInputMother;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\DependsExternal;
use PHPUnit\Framework\TestCase;

final class FoldingProcessTest extends TestCase
{
    #[DataProviderExternal(FoldingProcessDataProvider::class, 'data')]
    public function test fold(int $steps, Compound|Particle|Pair $given): void
    {
        $sut = FoldingProcess::ofInstructions(...FoldingInstructionMother::some());

        $actual = $sut->fold($given);

        self::assertTrue($actual instanceof Protomolecule);
        self::assertSame($steps, $sut->stepsCount());
    }

    #[DataProviderExternal(FoldingProcessDataProvider::class, 'edge cases')]
    public function test edge cases(string $molecule, string $expected): void
    {
        $this->markTestSkipped('Folding is in shambles :(');
        $chemistry = ChemistryMother::some();
        $sut = FoldingProcess::ofInstructions(...$chemistry->instructions);
        $structure = MoleculeParser::of($chemistry)->build($molecule);
        $actual = $sut->fold($structure);
        self::assertSame($expected, (string)$actual);
    }

    #[Depends('test edge cases')]
    #[DependsExternal(MoleculeParserTest::class, 'test fold')]
    public function test ultimate(): void
    {
        $this->markTestSkipped('Folding is in shambles :(');
        $data = NuclearMedicineInputMother::some();
        $chemistry = ChemistryFactory::ofReplacements(...$data->replacements);
        $sut = FoldingProcess::ofInstructions(...$chemistry->instructions);
        $moleculeStructure = MoleculeParser::of($chemistry)->build($data->molecule);
        $result = $sut->fold($moleculeStructure);

        self::assertTrue($result instanceof Protomolecule);
    }
}
