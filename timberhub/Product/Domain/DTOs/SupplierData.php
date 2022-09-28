<?php

namespace Timberhub\Product\Domain\DTOs;

use Spatie\LaravelData\Data;

final class SupplierData extends Data
{
    public function __construct(
        public readonly string $name
    ){}
}
