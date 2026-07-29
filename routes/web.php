<?php

use Illuminate\Support\Facades\Route;
use OpenTelemetry\Context\Context;

Route::get('/testlog', function () {
    Log::notice("Test log");
    Log::error("Test error log");

   // 1/0;


// Returns the active context
// If no context is active, the root context is returned
    $context = Context::getCurrent();
    return response()->json(['ok', $context]);
});

Route::get('/', function () {
    return view('home');
});
