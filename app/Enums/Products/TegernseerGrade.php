<?php

namespace App\Enums\Products;

enum TegernseerGrade: string
{
    use HasTitleValue;
    use HasCaseValues;

    case O = 'O';
    case I = 'I';
    case II = 'II';
    case III = 'III';
    case IV = 'IV';
    case V = 'V';
}
