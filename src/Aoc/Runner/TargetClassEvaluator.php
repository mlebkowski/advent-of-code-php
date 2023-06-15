<?php

declare(strict_types=1);

namespace App\Aoc\Runner;

use PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode;
use PHPStan\PhpDocParser\Lexer\Lexer;
use PHPStan\PhpDocParser\Parser\ConstExprParser;
use PHPStan\PhpDocParser\Parser\PhpDocParser;
use PHPStan\PhpDocParser\Parser\TokenIterator;
use PHPStan\PhpDocParser\Parser\TypeParser;
use ReflectionClass;
use RuntimeException;

final class TargetClassEvaluator
{
    public static function getTargetClass(object $object): string
    {
        $class = new ReflectionClass($object);

        $lexer = new Lexer();
        $constExprParser = new ConstExprParser();
        $typeParser = new TypeParser($constExprParser);
        $phpDocParser = new PhpDocParser($typeParser, $constExprParser);
        // parsing and reading a PHPDoc string

        $docComment = $class->getDocComment()
            ?: throw new RuntimeException(sprintf('Class %s needs to have a doc comment', $object::class));
        $tokens = new TokenIterator($lexer->tokenize($docComment));
        $phpDocNode = $phpDocParser->parse($tokens);
        [$implements] = $phpDocNode->getImplementsTagValues();
        /** @var IdentifierTypeNode $node */
        [$node] = $implements->type->genericTypes;
        return sprintf('%s\%s', $class->getNamespaceName(), $node->name);
    }
}
