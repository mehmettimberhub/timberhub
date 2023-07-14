<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Responses\JsonCreatedResponse;
use App\Http\Responses\JsonOkResponse;
use Illuminate\Http\JsonResponse;
use App\Services\Products\ProductService;
use App\Actions\Products\DeleteProductAction;
use App\Actions\Products\SaveProductAction;
use App\DTO\Products\ProductData;
use App\Models\Products\Product;
use App\Http\Requests\Products\CreateProductRequest;
use App\Http\Requests\Products\ProductListRequest;
use App\Http\Resources\Products\ProductResource;
use OpenApi\Annotations as OA;

class ProductApiController extends Controller
{
    public function __construct(
        private readonly ProductService $service
    )
    {
    }

    /**
     * @OA\Get(path="/api/products",
     *     tags={"products"},
     *     summary="Get all products",
     *     operationId="product-list",
     *     @OA\Parameter(
     *          name="searchTerm",
     *          in="path",
     *          required=false,
     *          @OA\Schema(type="string")
     *      ),
     *      @OA\Parameter(
     *          name="supplier_id",
     *          in="path",
     *          required=false,
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Country list data",
     *          @OA\JsonContent(ref="#/components/schemas/ProductResource"),
     *      ),
     * )
     */
    public function index(ProductListRequest $request): JsonResponse
    {
        return new JsonResponse(
            ProductResource::formatCollection(
                $this->service->getAllPaginated(20, 'id', true, $request->searchTerm, $request->supplier_id),
                ['Products successfully fetched']
            )
        );
    }

    /**
     * @OA\Post(path="/api/products",
     *  tags={"products"},
     *  summary="Create a new product",
     *  operationId="products-create",
     *  @OA\RequestBody(
     *      required=true,
     *      @OA\JsonContent(ref="#/components/schemas/CreateProductRequest"),
     *  ),
     *  @OA\Response(
     *      response=201,
     *      description="Product created data",
     *      @OA\JsonContent(ref="#/components/schemas/ProductResource"),
     *  ),
     *  @OA\Response(
     *      response=422,
     *      description="Product create invalid data",
     *      @OA\JsonContent(ref="#/components/schemas/JsonExceptionResource"),
     *  ),
     * ),
     */
    public function store(CreateProductRequest $request): JsonCreatedResponse
    {
        return new JsonCreatedResponse(
            ProductResource::make(
                SaveProductAction::execute(ProductData::fromRequest($request), null, $request->suppliers),
                ['product created']
            )
        );
    }

    /**
     * @OA\Put(path="/api/products/{product}",
     *  tags={"products"},
     *  summary="Update a product",
     *  operationId="products-update",
     *  @OA\RequestBody(
     *      required=true,
     *      @OA\JsonContent(ref="#/components/schemas/CreateProductRequest"),
     *  ),
     *  @OA\Response(
     *      response=201,
     *      description="Product created data",
     *      @OA\JsonContent(ref="#/components/schemas/ProductResource"),
     *  ),
     *  @OA\Response(
     *      response=422,
     *      description="Product create invalid data",
     *      @OA\JsonContent(ref="#/components/schemas/JsonExceptionResource"),
     *  ),
     * ),
     */
    public function update(CreateProductRequest $request, Product $product): JsonCreatedResponse
    {
        return new JsonCreatedResponse(
            ProductResource::make(
                SaveProductAction::execute(ProductData::fromRequest($request), $product, $request->suppliers),
                ['product created']
            )
        );
    }

    /**
     * @OA\Delete(
     *     path="products/{product}",
     *      tags={"products"},
     *     summary="This method is for deleting product",
     *     operationId="delete-product",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="product id",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *     )
     *   ),
     *   @OA\Response(
     *       response=404,
     *       description="Invalid product",
     *   ),
     * )
     */
    public function destroy(Product $product) : JsonResponse
    {
        DeleteProductAction::execute($product);
        return new JsonOkResponse(
            ProductResource::makeDeletedResource()
        );
    }
}
