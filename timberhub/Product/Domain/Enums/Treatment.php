<?php

namespace Timberhub\Product\Domain\Enums;

enum Treatment : string
{
    use HasTitleValue;
    use HasCaseValues;

    case HEAT = 'heat';
    case ANTI_STAIN = 'anti_stain';
}
