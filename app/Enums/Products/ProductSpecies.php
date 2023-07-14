<?php

namespace App\Enums\Products;

enum ProductSpecies : string
{
    use HasTitleValue;
    use HasCaseValues;

    case PINE = 'pine';
    case SPRUCE = 'spruce';
    case FIR = 'fir';
    case BIRCH = 'birch';
    case APPLE = 'apple';
}
