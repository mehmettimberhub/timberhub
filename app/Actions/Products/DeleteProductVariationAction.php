<?php

namespace App\Actions\Products;

use App\Models\Products\ProductVariation;

class DeleteProductVariationAction
{
    public static function execute(int $id) : void
    {
        $productVariation = ProductVariation::find($id);
        $productVariation->delete();
    }
}
