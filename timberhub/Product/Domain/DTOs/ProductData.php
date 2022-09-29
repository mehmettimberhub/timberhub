<?php

namespace Timberhub\Product\Domain\DTOs;

use Spatie\LaravelData\Data;
use Timberhub\Product\Domain\Enums\DyingMethod;
use Timberhub\Product\Domain\Enums\Grade;
use Timberhub\Product\Domain\Enums\GradingSystem;
use Timberhub\Product\Domain\Enums\ProductSpecies;
use Timberhub\Product\Domain\Enums\Treatment;
use Timberhub\Product\UI\Requests\CreateProductRequest;

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
