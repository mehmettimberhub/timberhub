<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(title="JsonCommonResource"),
 *  @OA\Property(
 *      property="success",
 *      type="boolean",
 *      example="true"
 *  ),
 *  @OA\Property(
 *      property="messages",
 *      type="null",
 *      example="['Everything is OK!']"
 *  ),
 *  @OA\Property(
 *      property="data",
 *      type="null",
 *      example="['everything' => 'OK']"
 *  ),
 */
abstract class JsonCommonResource extends JsonResource
{
    public $resource;

    protected $messages;
    protected $success;

    public function __construct($resource, $messages = null, $success = true)
    {
        parent::__construct($resource);

        $this->success = $success;
        $this->messages = $messages;
    }

    public static function makeDeletedResource(): array
    {
        return [
            'success' => true,
            'messages' => ['successfully deleted'],
            'data' => null,
        ];
    }

    public static function formatCollection($resource, ?array $messages = null, bool $success = true): array
    {
        assert($resource instanceof LengthAwarePaginator);

        $collection = parent::collection($resource);

        return [
            'messages' => $messages,
            'success' => $success,
            'data' => $collection->map(
                fn($item) => $item->getData(),
            ),
            'meta' => [
                'total' => $resource->total(),
                'per_page' => $resource->perPage(),
                'current_page' => $resource->currentPage(),
                'last_page' => $resource->lastPage(),
            ],
        ];
    }

    public function toArray($request): array
    {
        return [
            'success' => $this->isSuccess(),
            'messages' => $this->getMessages(),
            'data' => $this->getData(),
        ];
    }

    protected function getData(): ?array
    {
        return null;
    }

    protected function isSuccess(): bool
    {
        return $this->success;
    }

    protected function getMessages(): ?array
    {
        return $this->messages;
    }
}

