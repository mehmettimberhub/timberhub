<?php

namespace App\Http\Requests\Products;
use App\Http\Requests\JsonRequest;
use JetBrains\PhpStorm\ArrayShape;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(title="ProductListRequest")
 * @OA\Property(
 *     property="searchTerm",
 *     type="string",
 *     example="product",
 * )
 *  * @OA\Property(
 *     property="supplier_id",
 *     type="int",
 *     example="1",
 * )
 */
final class ProductListRequest extends JsonRequest
{

    #[ArrayShape(['searchTerm' => "string[]", 'supplier_id' => "string[]"])]
    public function rules(): array
    {
        return [
            'searchTerm' => [
                'nullable',
                'sometimes',
                'string',
            ],
            'supplier_id' => [
                'nullable',
                'sometimes',
                'integer',
            ],
        ];
    }
}
