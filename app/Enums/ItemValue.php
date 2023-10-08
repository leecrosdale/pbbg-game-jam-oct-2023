<?php

namespace App\Enums;

enum ItemValue : string
{
    case COMMON = 'common';
    case UNCOMMON = 'uncommon';
    case RARE = 'rare';
    case SPECIAL = 'special';
    case UNIQUE = 'unique';
}
