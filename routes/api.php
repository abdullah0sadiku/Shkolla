<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Ketu do ti ndertojm URL-at per API qe e mundesojn komunikimin me front-end per Mesues , Student , dhe drejtoria 
// Hapi i par do te jet krijimi i logjikes se Drejtoris sepse nga kjo pastaj bazohem ne pjest tjera te projektit. 