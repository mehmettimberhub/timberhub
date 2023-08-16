<?php

namespace App\Http\Requests\Products;
use App\Http\Requests\JsonRequest;
use JetBrains\PhpStorm\ArrayShape;
use OpenApi\Annotations as OA;
use App\Enums\Products\DyingMethod;
use App\Enums\Products\Grade;
use App\Enums\Products\GradingSystem;
use App\Enums\Products\NordicBlueGrade;
use App\Enums\Products\ProductSpecies;
use App\Enums\Products\TegernseerGrade;
use App\Enums\Products\Treatment;

/**
 * @OA\Schema(title="ProductListRequest")
 * @OA\Property(
 *     property="species",
 *     type="string",
 *     example="apple",
 * ),
 *  @OA\Property(
 *     property="gradingSystem",
 *     type="string",
 *     example="nordic_blue",
 * ),
 * @OA\Property(
 *     property="grade",
 *     type="string",
 *     example="A1",
 * ),
 * @OA\Property(
 *     property="dyingMethod",
 *     type="string",
 *     example="kiln_dried",
 * ),
 * @OA\Property(
 *     property="treatment",
 *     type="string",
 *     example="anti_stain",
 * ),
 * @OA\Property(
 *     property="thickness",
 *     type="int",
 *     example="30",
 * ),
 * @OA\Property(
 *     property="width",
 *     type="int",
 *     example="120",
 * ),
 * @OA\Property(
 *     property="length",
 *     type="int",
 *     example="1200",
 * ),
 */
class CreateProductRequest extends JsonRequest
{

    #[ArrayShape(['product' => "string", 'species' => "string", 'gradingSystem' => "string", 'grade' => "string", 'dyingMethod' => "string", 'treatment' => "string", 'thickness' => "string", 'width' => "string", 'length' => "string"])]
    public function rules(): array
    {
        $rules =  [
            'product' => 'nullable',
            'species' => 'required|in:' . implode(',', ProductSpecies::caseValues()),
            'gradingSystem' => 'required|in:' . implode(',', GradingSystem::caseValues()),
            'dyingMethod' => 'required|in:' . implode(',', DyingMethod::caseValues()),
            'treatment' => 'nullable|in:' . implode(',', Treatment::caseValues()) . ', 0',
            'thickness' => 'required|integer',
            'width' => 'required|integer',
            'length' => 'required|integer',
        ];
        if($this->gradingSystem === GradingSystem::NORDIC_BLUE->value){
            $rules['grade'] = 'required|in:' . implode(',', NordicBlueGrade::caseValues());
        }else{
            $rules['grade'] = 'required|in:' . implode(',', TegernseerGrade::caseValues());
        }
        return $rules;
    }
}
