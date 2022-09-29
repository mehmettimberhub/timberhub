<?php

namespace Timberhub\Product\Domain\Enums;

enum ProductSpecies : string
{
    use HasTitleValue;

    case PINE = 'pine';
    case SPRUCE = 'spruce';
    case FIR = 'fir';
    case BIRCH = 'birch';
    case APPLE = 'apple';
}
