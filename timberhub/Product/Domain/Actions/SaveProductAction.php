<?php

namespace Timberhub\Product\Domain\Actions;

use Timberhub\Product\Domain\DTOs\ProductData;
use Timberhub\Product\Domain\Models\Product;

class SaveProductAction
{
    public static function execute(ProductData $data, ?Product $product = null, array $suppliers) : Product
    {
        $product =  Product::updateOrCreate(
            [
                'id' => $product?->id
            ],
            [
                'species' => $data->species,
                'dying_method' => $data->dyingMethod,
                'grading_system' => $data->gradingSystem,
                'grading' => $data->grade,
                'treatment' => $data->treatment,
                'thickness' => $data->thickness,
                'width' => $data->width,
                'length' => $data->length
            ]
        );

        $product->suppliers()->sync($suppliers);
        return $product;
    }
}
