<?php

namespace Timberhub\Product\Domain\Enums;

use Illuminate\Support\Str;

enum GradingSystem : string
{
    use HasTitleValue;

    case NORDIC_BLUE = 'nordic_blue';
    case TEGERNSEER = 'tegernseer';
}
