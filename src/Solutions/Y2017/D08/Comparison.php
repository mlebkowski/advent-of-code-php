<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D08;

enum Comparison: string
{
    case GreaterThan = '>';
    case GreaterThanOrEqual = '>=';
    case LessThan = '<';
    case LessThanOrEqual = '<=';
    case Equal = '==';
    case NotEqual = '!=';
}
