<?php

namespace Timberhub\Supplier\Domain\DTOs;

use Spatie\LaravelData\Data;
use Timberhub\Supplier\UI\Requests\CreateSupplierRequest;

final class SupplierData extends Data
{
    public function __construct(
        public readonly string $name
    ){}

    public static function fromRequest(CreateSupplierRequest $request) : self
    {
        return new self(
            $request->validated('name')
        );
    }
}
