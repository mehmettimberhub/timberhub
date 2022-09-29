<?php

namespace Timberhub\Supplier\UI\Http;

use App\Http\Controllers\Controller;
use App\Http\Responses\JsonCreatedResponse;
use App\Http\Responses\JsonOkResponse;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;
use Timberhub\Supplier\Application\Service\SupplierService;
use Timberhub\Supplier\Domain\Actions\DeleteSupplierAction;
use Timberhub\Supplier\Domain\Actions\SaveSupplierAction;
use Timberhub\Supplier\Domain\DTOs\SupplierData;
use Timberhub\Supplier\Domain\Models\Supplier;
use Timberhub\Supplier\UI\Requests\CreateSupplierRequest;
use Timberhub\Supplier\UI\Requests\SupplierListRequest;
use Timberhub\Supplier\UI\Requests\UpdateSupplierRequest;
use Timberhub\Supplier\UI\Resources\SupplierResource;

class SupplierApiController extends Controller
{
    public function __construct(
        private readonly SupplierService $service,
    )
    {
    }

    /**
     * @OA\Get(path="suppliers",
     *     tags={"suppliers"},
     *     summary="Get all suppliers",
     *     operationId="supplier-list",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#components/schemas/SupplierListRequest"),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Country list data",
     *          @OA\JsonContent(ref="#/components/schemas/SupplierResource"),
     *      ),
     * )
     */
    public function index(SupplierListRequest $request): JsonResponse
    {
        return new JsonResponse(
            SupplierResource::formatCollection(
                $this->service->getAllPaginated(20, 'id', true, $request->searchTerm),
                ['Suppliers successfully fetched']
            )
        );
    }

    /**
     * @OA\Post(path="/supplier",
     *  tags={"supplier"},
     *  summary="Create a new supplier",
     *  operationId="suppliers-create",
     *  @OA\RequestBody(
     *      required=true,
     *      @OA\JsonContent(ref="#/components/schemas/CreateSupplierRequest"),
     *  ),
     *  @OA\Response(
     *      response=201,
     *      description="Supplier created data",
     *      @OA\JsonContent(ref="#/components/schemas/SupplierResource"),
     *  ),
     *  @OA\Response(
     *      response=422,
     *      description="Supplier create invalid data",
     *      @OA\JsonContent(ref="#/components/schemas/JsonExceptionResource"),
     *  ),
     * ),
     */
    public function store(CreateSupplierRequest $request): JsonResponse
    {
        return new JsonCreatedResponse(
            SupplierResource::make(
                SaveSupplierAction::execute(SupplierData::fromRequest($request), null),
                ['supplier created']
            )
        );
    }

    /**
     * @OA\Put(path="/suppliers/{supplier}",
     *  tags={"suppliers"},
     *  summary="Edit Supplier",
     *  operationId="suppliers-edit",
     *  @OA\RequestBody(
     *      required=true,
     *      @OA\JsonContent(ref="#/components/schemas/UpdateSupplierRequest"),
     *  ),
     *  @OA\Parameter(
     *      name="supplier",
     *      in="path",
     *      description="Supplier id",
     *      required=true,
     *      @OA\Schema(
     *          type="integer",
     *      ),
     *  ),
     *  @OA\Response(
     *      response=200,
     *      description="Supplier edited data",
     *      @OA\JsonContent(ref="#/components/schemas/SupplierResource"),
     *  ),
     *  @OA\Response(
     *      response=401,
     *      description="User Unauthorized",
     *      @OA\JsonContent(ref="#/components/schemas/JsonExceptionResource"),
     *  ),
     *   @OA\Response(
     *       response=404,
     *       description="Invalid supplier",
     *  ),
     *  @OA\Response(
     *      response=422,
     *      description="Supplier create invalid data",
     *      @OA\JsonContent(ref="#/components/schemas/JsonExceptionResource"),
     *  ),
     * ),
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier): JsonResponse
    {
        return new JsonOkResponse(
            SupplierResource::make(
                SaveSupplierAction::execute(SupplierData::fromRequest($request), $supplier),
                [trans('suppliers.edit.success')]
            )
        );
    }

    /**
     * @OA\Delete(
     *     path="suppliers/{supplier}",
     *      tags={"suppliers"},
     *     summary="This method is for deleting supplier",
     *     operationId="delete-supplier",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     description="supplier id",
     *     required=true,
     *     @OA\Schema(
     *       type="integer",
     *     )
     *   ),
     *   @OA\Response(
     *       response=404,
     *       description="Invalid supplier",
     *   ),
     * )
     */
    public function destroy(Supplier $supplier) : JsonResponse
    {
        DeleteSupplierAction::execute($supplier);
        return new JsonOkResponse(
            SupplierResource::makeDeletedResource()
        );
    }
}
