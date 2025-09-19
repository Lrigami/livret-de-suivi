<?php

namespace App\Enum;

enum PeriodType: string
{
    case vacances = 'Vacances';
    case formation = 'Formation';
    case stage = 'Stage';
    case fermé = 'Pont/Jour férié';
}

