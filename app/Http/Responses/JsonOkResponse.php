<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

final class JsonOkResponse extends JsonResponse
{
    public function __construct($data)
    {
        parent::__construct($data, JsonResponse::HTTP_OK);
    }
}
