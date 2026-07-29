<?php

namespace Modules\ActirovkiWidget\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Context;

abstract class Controller extends BaseController
{
    public function __construct()
    {
        Context::add('module', 'ActirovkiWidget');
    }
}
