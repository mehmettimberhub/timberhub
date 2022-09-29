<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

final class JsonCreatedResponse extends JsonResponse
{
    public function __construct($data)
    {
        parent::__construct($data, JsonResponse::HTTP_CREATED);
    }
}
