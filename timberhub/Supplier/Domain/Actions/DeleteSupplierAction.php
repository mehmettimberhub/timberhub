<?php

namespace Timberhub\Supplier\Domain\Actions;

use Timberhub\Supplier\Domain\Models\Supplier;

final class DeleteSupplierAction
{
    public static function execute(Supplier $supplier) : void
    {
        $supplier->delete();
    }
}
