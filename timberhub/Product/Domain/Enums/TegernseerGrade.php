<?php

namespace Timberhub\Product\Domain\Enums;

enum TegernseerGrade: string
{
    use HasTitleValue;

    case O = 'O';
    case I = 'I';
    case II = 'II';
    case III = 'III';
    case IV = 'IV';
    case V = 'V';
}
