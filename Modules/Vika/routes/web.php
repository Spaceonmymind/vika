<?php

use Illuminate\Support\Facades\Route;

Route::get('/vika/{any?}', function () {
    return view('vika::index');
})->where('any', '.*')->name('vika');
