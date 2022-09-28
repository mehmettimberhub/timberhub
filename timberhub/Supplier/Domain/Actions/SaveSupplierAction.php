<?php

namespace Timberhub\Supplier\Domain\Actions;

use Timberhub\Product\Domain\DTOs\SupplierData;
use Timberhub\Supplier\Domain\Models\Supplier;

final class SaveSupplierAction
{
    public static function execute(SupplierData $supplierData, Supplier $supplier) : Supplier
    {
        return Supplier::updateOrCreate(
            [
                'id' => $supplier?->id
            ],
            [
                'name' => $supplierData->name
            ]
        );
    }
}
