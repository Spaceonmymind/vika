<?php

namespace Modules\ActirovkiWidget\Enums;

enum ActirovkaStatus: string
{
    case Pending = 'pending';
    case Announced = 'announced';
    case NotAnnounced = 'not_announced';
}
