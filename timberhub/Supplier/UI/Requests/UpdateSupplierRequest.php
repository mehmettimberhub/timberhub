<?php

namespace Timberhub\Supplier\UI\Requests;
use App\Http\Requests\JsonRequest;
use JetBrains\PhpStorm\ArrayShape;
use OpenApi\Annotations as OA;
use Tests\Feature\Timberhub\Supplier\UI\Http\CreateSupplierTest;

/**
 * @OA\Schema(title="SupplierListRequest")
 * @OA\Property(
 *     property="name",
 *     type="string",
 *     example="supplier",
 * ),
 */
final class UpdateSupplierRequest extends CreateSupplierRequest
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
