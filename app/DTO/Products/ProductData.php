<?php

namespace App\DTO\Products;

use Spatie\LaravelData\Data;
use App\Enums\Products\DyingMethod;
use App\Enums\Products\Grade;
use App\Enums\Products\GradingSystem;
use App\Enums\Products\ProductSpecies;
use App\Enums\Products\Treatment;
use App\Http\Requests\Products\CreateProductRequest;

class ProductData extends Data
{
    public function __construct(
        public ProductSpecies $species,
        public GradingSystem $gradingSystem,
        public Grade $grade,
        public DyingMethod $dyingMethod,
        public ?Treatment $treatment,
        public int $thickness,
        public int $width,
        public int $length,
    )
    {
    }

    public static function fromRequest(CreateProductRequest $request)
    {
        return new self(
            ProductSpecies::tryFrom($request->species),
            GradingSystem::tryFrom($request->gradingSystem),
            Grade::tryFrom($request->grade),
            DyingMethod::tryFrom($request->dyingMethod),
            Treatment::tryFrom($request->treatment),
            $request->thickness,
            $request->width,
            $request->length
        );
    }
}
