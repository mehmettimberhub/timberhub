<?php

namespace App\Actions\Products;

use App\DTO\Products\ProductData;
use App\Models\Products\Product;
use Illuminate\Support\Facades\DB;

class SaveProductAction
{
    public static function execute(ProductData $data, ?Product $product = null) : Product
    {
        return DB::transaction(function () use ($data, $product) {
            $product =  Product::updateOrCreate([
                    'species' => $data->species,
                    'dying_method' => $data->dyingMethod,
                    'grading_system' => $data->gradingSystem,
                    'grading' => $data->grade,
                    'treatment' => $data->treatment,
                ]);

            $product->productVariations()->updateOrCreate([
                    'thickness' => $data->thickness,
                    'width' => $data->width,
                    'length' => $data->length,
                ]);
            return $product;
        });
    }
}
