<?php

namespace Timberhub\Product\Domain\Enums;

enum Treatment : string
{
    use HasTitleValue;

    case HEAT = 'heat';
    case ANTI_STAIN = 'anti_stain';
}
