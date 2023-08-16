<?php

namespace App\Http\Resources\Products;
use App\Http\Resources\JsonCommonResource;
use App\Models\Products\ProductVariation;

/**
 * @OA\Schema(title="ProductVariationResorce"),
 * @OA\Property(
 *     property="thickness",
 *     type="int",
 *     example="30",
 * ),
 * @OA\Property(
 *     property="width",
 *     type="int",
 *     example="120",
 * ),
 * @OA\Property(
 *     property="length",
 *     type="int",
 *     example="1200",
 * ),
 */
class ProductVariationResorce extends JsonCommonResource
{
    public function getData(): ?array
    {
        assert($this->resource instanceof ProductVariation);
        return [
            'thickness' => $this->resource->thickness,
            'width' => $this->resource->width,
            'length' => $this->resource->length,
        ];
    }

}
