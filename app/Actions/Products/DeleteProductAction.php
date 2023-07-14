<?php

namespace App\Actions\Products;

use Timberhub\Product\Domain\Models\Product;

class DeleteProductAction
{
    public static function execute(Product $product) : void
    {
        $product->delete();
    }
}
