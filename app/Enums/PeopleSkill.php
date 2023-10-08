<?php

namespace App\Enums;

enum PeopleSkill : string
{
    case LOCKPICKING = 'lockpicking';
    case HACKING = 'hacking';
    case STEALTH = 'stealth';
    case COMBAT = 'combat';
    case FORGERY = 'forgery';
    case SAFECRACKING = 'safecracking';
    case MEDICINE = 'medicine';
    case DRIVING = 'driving';
}
