<?php

namespace App\Http\Resources;

use Exception;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(title="JsonExceptionResource"),
 *  @OA\Property(
 *      property="success",
 *      type="boolean",
 *      example="false"
 *  ),
 *  @OA\Property(
 *      property="messages",
 *      type="null",
 *      example="['Something wrong occured ...']"
 *  ),
 *  @OA\Property(
 *      property="data",
 *      type="null",
 *      example="null"
 *  ),
 */
final class JsonExceptionResource extends JsonCommonResource
{
    /** @var Exception  */
    public $resource;

    protected function isSuccess(): bool
    {
        return false;
    }

    protected function getMessages(): ?array
    {
        return [$this->messages ?? $this->resource->getMessage()];
    }
}
