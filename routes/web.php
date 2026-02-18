<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/check-db', function () {
    try {
        DB::connection()->getPdo();
        return "✅ Database connection is working: " . DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        return "❌ Could not connect to the database. Error: " . $e->getMessage();
    }
});
