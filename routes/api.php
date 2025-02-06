?<?php
use App\Http\Middleware\HandleCors;

Route::middleware([HandleCors::class])->group(function () {
    // Your API routes here
    Route::get('/example', function () {
        return response()->json(['message' => 'CORS is enabled']);
    });

    // Your other API routes
});
