<?php

namespace App\Enums\Products;

enum DyingMethod :string
{
    use HasTitleValue;
    use HasCaseValues;

    case FRESH = 'fresh';
    case KILN = 'kiln_dried';
    case AIR_DRIED = 'air_dried';
}
