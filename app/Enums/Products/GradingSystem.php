<?php

namespace App\Enums\Products;

use Illuminate\Support\Str;

enum GradingSystem : string
{
    use HasTitleValue;
    use HasCaseValues;

    case NORDIC_BLUE = 'nordic_blue';
    case TEGERNSEER = 'tegernseer';
}
