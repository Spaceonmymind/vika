<?php

namespace Modules\FuelPriceWidget\Constants;

enum FuelTypes: int
{
    case AI92 = 1;
    case AI95 = 2;
    case AI98 = 3;
    case AI100 = 4;
    case BUTANE = 5;
    case PROPANE = 6;
    case METHANE = 7;
    case DIESEL = 8;
}
