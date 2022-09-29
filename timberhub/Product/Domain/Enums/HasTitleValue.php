<?php

namespace Timberhub\Product\Domain\Enums;

use Illuminate\Support\Str;

trait HasTitleValue
{
    public function getValue(): string
    {
        return Str::title(str_replace('_', ' ', $this->value));
    }
}
