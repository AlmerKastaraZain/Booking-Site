<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::group(['prefix'=>'dashboard'], function () {
        Route::get("/analytics", function() {
            return view('vendors.analytics');
        })->name("analytics");
    
        Route::get("/listing", function() {
            return view('vendors.listing');
        })->name("listing");
    
        Route::get("/documentation", function() {
            return view('vendors.documentation');
        })->name("documentation");
    });

});
