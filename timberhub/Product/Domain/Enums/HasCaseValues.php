<?php

namespace Timberhub\Product\Domain\Enums;

trait HasCaseValues
{
    public static function caseValues() : array
    {
        return array_map(static fn($x) => $x->value, self::cases());
    }

}
