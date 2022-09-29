<?php

namespace Timberhub\Product\Domain\DTOs;

use Spatie\LaravelData\Data;
use Timberhub\Product\Domain\Enums\DyingMethod;
use Timberhub\Product\Domain\Enums\Grade;
use Timberhub\Product\Domain\Enums\GradingSystem;
use Timberhub\Product\Domain\Enums\ProductSpecies;
use Timberhub\Product\Domain\Enums\Treatment;

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
}
