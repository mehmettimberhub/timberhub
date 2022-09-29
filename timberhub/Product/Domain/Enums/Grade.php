<?php

namespace Timberhub\Product\Domain\Enums;

enum Grade : string
{
    use HasTitleValue;

    case A1 = 'A1';
    case A2 = 'A2';
    case A3 = 'A3';
    case A4 = 'A4';
    case B1 = 'B1';
    case O = 'O';
    case I = 'I';
    case II = 'II';
    case III = 'III';
    case IV = 'IV';
    case V = 'V';
}
