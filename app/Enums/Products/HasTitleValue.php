<?php

namespace App\Enums\Products;

use Illuminate\Support\Str;

trait HasTitleValue
{
    public function getValue(): string
    {
        return Str::title(str_replace('_', ' ', $this->value));
    }
}
