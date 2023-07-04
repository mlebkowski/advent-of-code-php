<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D09\Parser;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class StreamParserTest extends TestCase
{
    public static function data(): iterable
    {
        yield ['{}', '{}'];
        yield ['{<>}', '{}'];
        yield ['{<random characters>}', '{}'];
        yield ['{<<<<>}', '{}'];
        yield ['{<{!>}>}', '{}'];
        yield ['{<!!>}', '{}'];
        yield ['{<!!!>>}', '{}'];
        yield ['{<{o"i!a,<{i<a>}', '{}'];
        yield ['{{{}}}', '{{{}}}'];
        yield ['{{},{}}', '{{},{}}'];
        yield ['{{{},{},{{}}}}', '{{{},{},{{}}}}'];
        yield ['{<{},{},{{}}>}', '{}'];
        yield ['{<a>,<a>,<a>,<a>}', '{}'];
        yield ['{{<a>},{<a>},{<a>},{<a>}}', '{{},{},{},{}}'];
        yield ['{{<!>},{<!>},{<!>},{<a>}}', '{{}}'];
        yield ['{{<!!>},{<!!>},{<!!>},{<!!>}}', '{{},{},{},{}}'];
        yield ['{{<a!>},{<a!>},{<a!>},{<ab>}}', '{{}}'];
    }

    public static function garbage(): iterable
    {
        yield ['{<>}', ''];
        yield ['{<!!>}', ''];
        yield ['{<!!!>>}', ''];
        yield ['{<random characters>}', 'random characters'];
        yield ['{<<<<>}', '<<<'];
        yield ['{<{!>}>}', '{}'];
        yield ['{<{o"i!a,<{i<a>}', '{o"i,<{i<a'];
    }

    #[DataProvider('data')]
    public function test(string $input, string $expected): void
    {
        $sut = StreamParser::parse(...);
        $actual = $sut($input);
        self::assertSame($expected, (string)$actual);
    }

    #[DataProvider('garbage')]
    public function test garbage(string $input, string $expected): void
    {
        $garbageListener = GarbageListener::empty();
        $sut = StreamParser::parseWithMetadata(...);
        $sut($input, $garbageListener);
        $actual = implode("\n", $garbageListener->garbage());
        self::assertSame($expected, $actual);
    }
}
