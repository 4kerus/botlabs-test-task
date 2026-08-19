<?php

use App\Http\Controllers\{
    CallController,
    LeadController,
    ManagerController
};
use Illuminate\Support\Facades\Route;

Route::post('/leads', [LeadController::class, 'store']);
Route::post('/leads/{lead}/calls', [CallController::class, 'store']);
Route::get('/managers/{manager}/leads', [ManagerController::class, 'leads']);
