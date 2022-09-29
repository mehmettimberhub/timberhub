<?php

namespace Timberhub\Product\Domain\Actions;

use Timberhub\Product\Domain\Models\Product;

class DeleteProductAction
{
    public static function execute(Product $product) : void
    {
        $product->delete();
    }
}
