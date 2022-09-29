<?php

namespace Timberhub\Product\Domain\Enums;

enum DyingMethod :string
{
    use HasTitleValue;

    case FRESH = 'fresh';
    case KILN = 'kiln_dried';
    case AIR_DRIED = 'air_dried';
}
