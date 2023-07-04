<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D09\Parser;

use App\Solutions\Y2017\D09\Parser\Problems\ParserException;
use Throwable;

final class Tokenizer
{
    private const EscapeCharacter = '!';
    private const GroupDelimiter = ',';
    private const GroupOpen = '{';
    private const GroupClose = '}';
    private const GarbageOpen = '<';
    private const GarbageClose = '>';

    private ?Token $current = null;

    public static function of(InputStream $input): self
    {
        return new self($input);
    }

    private function __construct(private readonly InputStream $input)
    {
    }

    public function peek(): ?Token
    {
        return $this->current ?? $this->current = $this->readNext();
    }

    public function next(): ?Token
    {
        $token = $this->current;
        $this->current = null;
        return $token ?? $this->readNext();
    }

    public function eof(): bool
    {
        return null === $this->peek();
    }

    /**
     * @throws ParserException
     */
    public function croak(Throwable|string $error): never
    {
        $this->input->croak($error?->getMessage() ?? $error);
    }

    private function readNext(): ?Token
    {
        if ($this->input->eof()) {
            return null;
        }

        $chr = $this->input->peek();
        return match ($chr) {
            self::GarbageOpen => $this->readGarbage(),
            self::GroupOpen => Token::of(Type::GroupStart, $this->input->next()),
            self::GroupDelimiter => Token::of(Type::Delimiter, $this->input->next()),
            self::GroupClose => Token::of(Type::GroupEnd, $this->input->next()),
            default => $this->input->croak("Can't handle character: $chr"),
        };
    }

    private function readGarbage(): Token
    {
        $garbage = '';
        $this->input->next();
        while (false === $this->input->eof()) {
            $chr = $this->input->next();
            switch ($chr) {
                case self::EscapeCharacter:
                    $garbage .= $this->input->next();
                    break;
                case self::GarbageClose:
                    return Token::of(Type::Garbage, $garbage);
                default:
                    $garbage .= $chr;
            }
        }

        $this->input->croak("Unexpected eof while reading garbage");
    }
}
