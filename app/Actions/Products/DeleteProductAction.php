<?php

namespace App\Actions\Products;

use App\Models\Products\Product;

class DeleteProductAction
{
    public static function execute(Product $product) : void
    {
        $product->delete();
    }
}
