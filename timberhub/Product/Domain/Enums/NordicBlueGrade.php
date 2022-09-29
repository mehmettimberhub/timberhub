<?php

namespace Timberhub\Product\Domain\Enums;

enum NordicBlueGrade : string
{
    use HasTitleValue;

    case A1 = 'A1';
    case A2 = 'A2';
    case A3 = 'A3';
    case A4 = 'A4';
    case B1 = 'B1';
}
