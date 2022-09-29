<?php

namespace Timberhub\Supplier\UI\Requests;
use App\Http\Requests\JsonRequest;
use JetBrains\PhpStorm\ArrayShape;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(title="SupplierListRequest")
 * @OA\Property(
 *     property="name",
 *     type="string",
 *     example="supplier",
 * ),
 */
class CreateSupplierRequest extends JsonRequest
{
    #[ArrayShape(['name' => "string[]"])]
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'unique:suppliers'
            ],
        ];
    }
}
