<?php

use App\Http\Controllers\KycController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix("v1/")->middleware('whitelist')->group(function (){
    Route::apiResource('kyc',KycController::class)->only("store","show");
});
