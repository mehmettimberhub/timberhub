<?php

namespace Timberhub\Supplier\UI\Resources;

use App\Http\Resources\JsonCommonResource;
use JetBrains\PhpStorm\ArrayShape;
use OpenApi\Annotations as OA;
/**
 * @OA\Schema(title="SupplierResource"),
 *  @OA\Property(
 *      property="name",
 *      type="string",
 *      example="Timberhub"
 *  ),
 */
final class SupplierResource extends JsonCommonResource
{
    #[ArrayShape(['id' => "int", 'name' => "string"])]
    public function getData(): ?array
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
        ];
    }
}
