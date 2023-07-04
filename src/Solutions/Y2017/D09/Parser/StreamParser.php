<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D09\Parser;

use App\Solutions\Y2017\D09\Group;
use App\Solutions\Y2017\D09\Parser\Problems\TokenExpected;
use App\Solutions\Y2017\D09\Parser\Problems\UnexpectedEndOfFile;
use App\Solutions\Y2017\D09\Parser\Problems\UnexpectedToken;

final readonly class StreamParser
{
    public static function parse(string $stream): Group
    {
        return self::parseWithMetadata($stream, GarbageListener::empty());
    }

    public static function parseWithMetadata(string $stream, GarbageListener $garbageListener): Group
    {
        $inputStream = InputStream::of($stream);
        $tokenizer = Tokenizer::of($inputStream);
        $parser = new self($tokenizer, $garbageListener);
        return $parser->parseGroup();
    }

    private function __construct(private Tokenizer $tokenizer, private GarbageListener $garbageListener)
    {
    }

    private function parseGroup(): Group
    {
        $this->skipGroupOpen();
        $groups = [];

        while (false === $this->tokenizer->eof()) {
            $token = $this->tokenizer->peek();
            UnexpectedEndOfFile::whenNoMoreTokens($token);
            switch ($token->type) {
                case Type::GroupEnd:
                    $this->tokenizer->next();
                    return Group::of(...$groups);
                case Type::Garbage:
                    $this->garbageListener->push($token);
                    $this->tokenizer->next(); // discard!
                    $this->expectDelimiterOrGroupEnd();
                    break;
                case Type::GroupStart:
                    $groups[] = $this->parseGroup();
                    $this->expectDelimiterOrGroupEnd();
                    break;
                default:
                    $this->tokenizer->croak(UnexpectedToken::of($token));
            }
        }
        $this->tokenizer->croak('Unexpected eof while parsing group');
    }

    private function skipGroupOpen(): void
    {
        TokenExpected::ofType($this->tokenizer, Type::GroupStart);
        $this->tokenizer->next();
    }

    private function expectDelimiterOrGroupEnd(): void
    {
        $token = $this->tokenizer->peek();
        if ($token?->type === Type::Delimiter) {
            $this->tokenizer->next();
            // avoid dangling commas: ,)
            UnexpectedToken::whenOfType(Type::GroupEnd, $this->tokenizer->peek());
            return;
        }

        TokenExpected::ofType($this->tokenizer, Type::GroupEnd);
    }
}
