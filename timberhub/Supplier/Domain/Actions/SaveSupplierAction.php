<?php

namespace Timberhub\Supplier\Domain\Actions;

use Timberhub\Supplier\Domain\DTOs\SupplierData;
use Timberhub\Supplier\Domain\Models\Supplier;

final class SaveSupplierAction
{
    public static function execute(SupplierData $supplierData, ?Supplier $supplier = null) : Supplier
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
