<?php

namespace Timberhub\Supplier\UI\Requests;
use App\Http\Requests\JsonRequest;
use JetBrains\PhpStorm\ArrayShape;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(title="SupplierListRequest")
 * @OA\Property(
 *     property="searchTerm",
 *     type="string",
 *     example="supplier",
 * )
 */
final class SupplierListRequest extends JsonRequest
{
    #[ArrayShape(['searchTerm' => "string[]"])]
    public function rules(): array
    {
        return [
            'searchTerm' => [
                'nullable',
                'sometimes',
                'string',
            ],
        ];
    }
}
