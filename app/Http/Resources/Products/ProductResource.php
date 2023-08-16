<?php

namespace App\Http\Resources\Products;

use App\Http\Resources\JsonCommonResource;
use App\Services\Products\ProductService;
use JetBrains\PhpStorm\ArrayShape;
use OpenApi\Annotations as OA;
use App\Models\Products\Product;

/**
 * @OA\Schema(title="SupplierResource"),
 * @OA\Property(
 *     property="species",
 *     type="string",
 *     example="apple",
 * ),
 *  @OA\Property(
 *     property="gradingSystem",
 *     type="string",
 *     example="nordic_blue",
 * ),
 * @OA\Property(
 *     property="grade",
 *     type="string",
 *     example="A1",
 * ),
 * @OA\Property(
 *     property="dyingMethod",
 *     type="string",
 *     example="kiln_dried",
 * ),
 * @OA\Property(
 *     property="treatment",
 *     type="string",
 *     example="anti_stain",
 * ),
 * @OA\Property(
 *     property="variations",
 *     type="array",
 *     @OA\JsonContent(ref="#/components/schemas/ProductVariationResource"),
 * ),
 */
final class ProductResource extends JsonCommonResource
{
    public function getData(): ?array
    {
        assert($this->resource instanceof Product);
        $service = app(ProductService::class);
        return [
            'id' => $this->resource->id,
            'species' => $this->resource->species,
            'dyingMethod' => $this->resource->dying_method,
            'gradingSystem' => $this->resource->grading_system,
            'grade' => $this->resource->grading,
            'treatment' => $this->resource->treatment,
            'variations' => ProductVariationResorce::formatCollection(
                $service->getVariationsOfProductPaginated($this->resource)
            ),
        ];
    }
}
